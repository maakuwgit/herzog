/**
 * dat.globe Javascript WebGL Globe Toolkit
 * https://github.com/dataarts/webgl-globe
 *
 * Copyright 2011 Data Arts Team, Google Creative Lab
 *
 * Licensed under the Apache License, Version 2.0 (the 'License');
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 */

var DAT = DAT || {};

DAT.Globe = function(container, opts) {
  opts = opts || {};

  var imgDir = opts.imgDir || '/wp-content/themes/herzog/assets/img/';

  var raycaster = new THREE.Raycaster();
  var mousetoo = new THREE.Vector2();

  var earth = new Object();
      earth.radius = 200,
      earth.orbit  = earth.radius * 3;

  var Shaders = {
    'earth' : {
      uniforms: {
        'texture': { type: 't', value: null }
      },
      vertexShader: [
        'varying vec3 vNormal;',
        'varying vec2 vUv;',
        'void main() {',
          'gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );',
          'vNormal = normalize( normalMatrix * normal );',
          'vUv = uv;',
        '}'
      ].join('\n'),
      fragmentShader: [
        'uniform sampler2D texture;',
        'varying vec3 vNormal;',
        'varying vec2 vUv;',
        'void main() {',
          'vec3 diffuse = texture2D( texture, vUv ).xyz;',
          'float intensity = 1.05 - dot( vNormal, vec3( 0.0, 0.0, 1.0 ) );',
          'vec3 atmosphere = vec3( 1.0, 1.0, 1.0 ) * pow( intensity, 3.0 );',
          'gl_FragColor = vec4( diffuse + atmosphere, 1.0 );',
        '}'
      ].join('\n')
    },
    'atmosphere' : {
      uniforms: {},
      vertexShader: [
        'varying vec3 vNormal;',
        'void main() {',
          'vNormal = normalize( normalMatrix * normal );',
          'gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );',
        '}'
      ].join('\n'),
      fragmentShader: [
        'varying vec3 vNormal;',
        'void main() {',
          'float intensity = pow( 0.8 - dot( vNormal, vec3( 0, 0, 1.0 ) ), 12.0 );',
          'gl_FragColor = vec4( 1.0, 1.0, 1.0, 1.0 ) * intensity;',
        '}'
      ].join('\n')
    },
    'hotspot' : {
      uniforms: {
      'color1' : { type : 'c', value : new THREE.Color(0xffffff) },
      'color2' : { type : 'c', value : new THREE.Color(0x000000) },
      },
      vertexShader: [
        'varying vec2 vUv;',
        'void main() {',
        'vUv = uv;',
          'gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0);',
        '}'
      ].join('\n'),
      fragmentShader: [
        'uniform vec3 color1;',
        'uniform vec3 color2;',
        'varying vec2 vUv;',
        'void main() {',
          'gl_FragColor = vec4(mix(color1, color2, vUv.y),1.0);',
        '}'
      ].join('\n')
    }
  };

  var camera, scene, renderer, w, h, light;
  var mesh, atmosphere, points, starField;

  var overRenderer;

  var curZoomSpeed = 0;
  var zoomSpeed = 50;

  var mouse = { x: 0, y: 0 }, mouseOnDown = { x: 0, y: 0 };
  var rotation = { x: 0, y: 0 },
      target = { x: Math.PI*3/2, y: Math.PI / 6.0 },
      targetOnDown = { x: 0, y: 0 };

  var multiplier = 10000;

  var distance = multiplier, distanceTarget = multiplier;
  var padding = 40;
  var PI_HALF = Math.PI / 2;

  var fontFamily = false;

  function init() {

    var shader, uniforms, material;
    w = container.offsetWidth || window.innerWidth;
    h = container.offsetHeight || window.innerHeight;

    //The Scene Camera
    camera = new THREE.PerspectiveCamera(30, w / h, 1, multiplier);
    camera.position.z = distance;
    scene = new THREE.Scene();
    scene.background = new THREE.Color( 0x000A15 );

    var loader = new THREE.FontLoader();
    loader.load( '../wp-content/themes/herzog/assets/fonts/helvetiker_regular.typeface.json', function(font){
      fontFamily = font;
    });

    // Mobile Controls (Dev Note: doesn't work, that I can see...)
    /*
    var options = {
      speedFactor: 0.5,
      delta: 1,
      rotationFactor: 0.002,
      maxPitch: 55,
      hitTest: true,
      hitTestDistance: 40
    };
    controls = new TouchControls($(container).parent(), camera, options);
    controls.setPosition(0, 35, 400);
    controls.addToScene(scene);
    */
    /* The globe itself, wrapped in our texture */
    var geometry = new THREE.SphereGeometry(earth.radius, 40, 30);

    shader = Shaders['earth'];
    uniforms = THREE.UniformsUtils.clone(shader.uniforms);

    uniforms['texture'].value = THREE.ImageUtils.loadTexture(imgDir+'world-3.jpg');

    material = new THREE.ShaderMaterial({
      uniforms: uniforms,
      vertexShader: shader.vertexShader,
      fragmentShader: shader.fragmentShader,
      transparent: true
    });

    mesh = new THREE.Mesh(geometry, material);
    mesh.rotation.y = Math.PI;
    scene.add(mesh);

    //Space, the final frontier...
    var starsGeometry = new THREE.Geometry();
    for ( var i = 0; i < distance * 5; i ++ ) {
      var star = new THREE.Vector3();
      star.x = THREE.Math.randFloatSpread( 2000 );
      star.y = THREE.Math.randFloatSpread( 2000 );
      star.z = THREE.Math.randFloatSpread( 2000 );

      starsGeometry.vertices.push( star );

    }

    var starsMaterial = new THREE.PointsMaterial( { color: 0xFFFFFF } );
    starField = new THREE.Points( starsGeometry, starsMaterial );
    scene.add( starField );

    /* White glow around the globe */
    shader = Shaders['atmosphere'];
    uniforms = THREE.UniformsUtils.clone(shader.uniforms);

    material = new THREE.ShaderMaterial({

          uniforms: uniforms,
          vertexShader: shader.vertexShader,
          fragmentShader: shader.fragmentShader,
          side: THREE.BackSide,
          blending: THREE.AdditiveBlending,
          transparent: true

        });

    mesh = new THREE.Mesh(geometry, material);
    mesh.scale.set( 1.1, 1.1, 1.1 );
    scene.add(mesh);


    // LIGHTS
    /*Dev Note: this appears to be doing nothing, but it's a position issue*/
    light = new THREE.SpotLight( 0xff0000, 1);
    light.position.set(1, earth.radius + 100, 1);
    light.castShadow = true;
    light.decay = 2;

    //scene.add( light );

    var spotLightHelper = new THREE.SpotLightHelper( light );
    //scene.add( spotLightHelper );

    renderer = new THREE.WebGLRenderer({antialias: true});
    renderer.setSize(w, h);

    renderer.domElement.style.position = 'absolute';

    container.appendChild(renderer.domElement);

    if( ! $('body').hasClass('single-project') ) {
      container.addEventListener('mouseover', onMouseOver, false);

      container.addEventListener('mousedown', onMouseDown, false);

      container.addEventListener('mousewheel', onMouseWheel, false);

      document.addEventListener('keydown', onDocumentKeyDown, false);

      window.addEventListener('resize', onWindowResize, false);

      container.addEventListener('mouseover', function() {
        overRenderer = true;
      }, false);

      container.addEventListener('mouseout', function() {
        overRenderer = false;
      }, false);
    }else{
      $('body').addClass('globe-selection-made');
    }
  }

  //Pushes the data into the point itself
  function addData(data, opts) {
    if( fontFamily ) {
      var lat, lng, size, color, i, step, colorFnWrapper;

      opts.animated = opts.animated || false;
      this.is_animated = opts.animated;
      opts.format = opts.format || 'magnitude'; // other option is 'legend'

      var color = new THREE.Color(0xfffff);

      step = 3;
      colorFnWrapper = function(data, i) {
        return  color;
      }

      if(this._morphTargetId === undefined) {
        this._morphTargetId = 0;
      } else {
        this._morphTargetId += 1;
      }
      opts.name = opts.name || 'morphTarget'+this._morphTargetId;

      var subgeo = new THREE.Geometry();
      for (i = 0; i < data.length; i += step) {
        lat = data[i];
        lng = data[i + 1];
        color = colorFnWrapper(data,i);
        size = data[i + 2];
        title = data[i + 3];
        slug = data[i + 4];
        id = data[i + 5];
        addPoint(lat, lng, size, color, subgeo, title, slug, id);
      }

    }else{
      //If we're still waiting on the font to load, give it another 3/10ths of a second and retry
      var redial = setTimeout(function(){
        addData(data, opts);
      }, 300);
    }
  };

  //Make the point itself, and add it to the Scene
  function createLocator(title='Lorem Ipsum') {
    this.geometry = new THREE.ConeGeometry( 1, 5, 32 );
    this.material = new THREE.MeshBasicMaterial( {color: 0xffffff} );
    this.point = new THREE.Mesh( this.geometry, this.material );

    scene.add(this.point);

    this.geometry = new THREE.RingGeometry( 1, 9, 64 );
    this.shader = Shaders['hotspot'];

    this.material = new THREE.ShaderMaterial({
      uniforms: shader.uniforms,
      vertexShader: shader.vertexShader,
      fragmentShader: shader.fragmentShader,
      side: THREE.BackSide,
      blending: THREE.AdditiveBlending,
      transparent: true
    });

    this.hotspot = new THREE.Mesh( this.geometry, this.material );

    scene.add(this.hotspot);

    this.geometry = new THREE.RingGeometry( 10, 11, 64 );
    this.material = new THREE.MeshBasicMaterial( { color: 0xffff00, side: THREE.DoubleSide, transparent:true, opacity:0 } );
    this.ring = new THREE.Mesh( this.geometry, this.material );

    scene.add(this.ring);

    this.material = new THREE.MeshBasicMaterial( { color: 0xffffff, transparent:true, opacity:0 } );
    this.geometry = new THREE.TextGeometry( title, {
      font: fontFamily,
      size: 3,
      height: 1,
      bevelEnabled: false
    } );

    this.blurb = new THREE.Mesh(this.geometry, this.material);

    scene.add(this.blurb);

    return [this.point, this.ring, this.hotspot, this.blurb];
  }

  //Gets called several times (up to 4) for each actual point, for the face of the cube methinks.
  function addPoint(lat, lng, size, color, subgeo, title, slug, id) {
    var locator = createLocator(title);
    var point = locator[0];
    var ring = locator[1];
    var hotspot = locator[2];
    var copy = locator[3];

    //Figure out where the points are on the map
    var phi = (90 - lat) * Math.PI / 180;
    var theta = (180 - lng) * Math.PI / 180;

    //Assign the Post ID to all the interactive objects so we know what we're clicking
    point.name = ring.name = hotspot.name = copy.name = id;

    point.position.x = 200 * Math.sin(phi) * Math.cos(theta);
    point.position.y = 210 * Math.cos(phi);
    point.position.z = 200 * Math.sin(phi) * Math.sin(theta);

    ring.position.x = hotspot.position.x = copy.position.x = point.position.x;
    ring.position.y = hotspot.position.y = copy.position.y = point.position.y;
    ring.position.z = hotspot.position.z = copy.position.z = point.position.z;


    point.lookAt(mesh.position.x, mesh.position.y, mesh.position.z);
    ring.lookAt(mesh.position);

    hotspot.lookAt(mesh.position);
    copy.lookAt(mesh.position);

    point.scale = Math.max( size, 0.1 );

    point.geometry.applyMatrix( new THREE.Matrix4().makeRotationX( Math.PI/2 ) );
    point.updateMatrix();
    ring.updateMatrix();
    hotspot.geometry.applyMatrix( new THREE.Matrix4().makeRotationY( Math.PI ) );
    hotspot.updateMatrix();
    copy.geometry.applyMatrix( new THREE.Matrix4().makeRotationY( Math.PI ) );
    copy.position.x -= 16;
    copy.position.z -= 8;
    copy.updateMatrix();

    subgeo.merge(point.geometry, point.matrix);
    subgeo.merge(ring.geometry, ring.matrix);
    subgeo.merge(hotspot.geometry, hotspot.matrix);
    subgeo.merge(copy.geometry, copy.matrix);
  }

  function checkForHits(event) {
    /*
    for(var h = 0; h < scene.children.length; h++){
      var victim = scene.children[ i ].object;
      switch( victim.geometry.type ){
        case 'ConeGeometry':
        case 'RingGeometry':
        case 'TextGeometry':
        break;
      }
    }*/
    // calculate the mouse position in "normalized device coordinates"
    // basically (-1 to +1) for both components
    mousetoo.x = ( event.clientX / w ) * 2 - 1;
    mousetoo.y = - ( event.clientY / h ) * 2 + 1;

    //update the "picking ray" with the camera and mouse position
    raycaster.setFromCamera( mousetoo, camera );

    //See if any cones or rings intersect the "picking ray"
    var intersects = raycaster.intersectObjects( scene.children );

    var collision = false;
    for ( var i = 0; i < intersects.length; i++ ) {
      var victim = intersects[ i ].object;
      /*Let's see what our mouse is touching...*/
      switch( victim.geometry.type ){
        case 'ConeGeometry':
        case 'RingGeometry':
        case 'TextGeometry':
        for(var c = 0; c < scene.children.length; c++){
           var child = scene.children[c];
           if(child.name === victim.name){
            switch(child.geometry.type){
              case 'TextGeometry':
                /*It's the blurb*/
                child.material.opacity = 1;
              break;
              case 'RingGeometry':
                /*It's the hotspot/ring*/
                /*Dev Note: this is likely overkill to recreate the whole shader,
                per-parameter based changes weren't working correclty*/
                this.shader = Shaders['hotspot'];
                this.material = new THREE.ShaderMaterial({
                  uniforms: shader.uniforms,
                  vertexShader: shader.vertexShader,
                  fragmentShader: shader.fragmentShader,
                  side: THREE.DoubleSide,
                  blending: THREE.AdditiveBlending,
                  transparent: true
                });

                /*Check if it's the hotspot, which has no color, if so, use the gradient on ALL faces now*/
                if( !child.material.color ) {
                  child.material = this.material;
                }else{
                  child.material.opacity = 1;
                }
              break;
              default:
                /*Its GOTTA be a cone..*/
                child.geometry = new THREE.ConeGeometry( 5, 20, 32 );
                child.lookAt(mesh.position.x, mesh.position.y, mesh.position.z);
                child.geometry.applyMatrix( new THREE.Matrix4().makeRotationX( Math.PI/2 ) );
                child.updateMatrix();
              break;
            }
           }
        }
        break;
        default:
          /*console.log('victim is a '+victim.geometry.type);*/
        break;
      }
    }
  }

  function onMouseOut(event) {
    console.log('out');
    container.removeEventListener('mousemove', checkForHits, false);
  }

  function onMouseOver(event) {
    console.log('over');
    container.addEventListener('mousemove', checkForHits, false);
  }

  function onMouseDown(event) {
    event.preventDefault();

    mouseOnDown.x = - event.clientX;
    mouseOnDown.y = event.clientY;

    // calculate the mouse position in "normalized device coordinates"
    // basically (-1 to +1) for both components
    mousetoo.x = ( event.clientX / w ) * 2 - 1;
    mousetoo.y = - ( event.clientY / h ) * 2 + 1;

    //update the "picking ray" with the camera and mouse position
    raycaster.setFromCamera( mousetoo, camera );

    //See if any cones or rings intersect the "picking ray"
    var intersects = raycaster.intersectObjects( scene.children );

    var collision = false;
    for ( var i = 0; i < intersects.length; i++ ) {
      var victim = intersects[ i ].object;
      //console.log(victim.geometry.type);
      //Let's see what our mouse is touching...
      switch( victim.geometry.type ){
        case 'ConeGeometry':
        case 'RingGeometry':
        case 'TextGeometry':
          $('body').addClass('globe-selection-made');
          $('[data-location="project-'+victim.name+'"]').addClass('active');
          collision = true;
        break;
        default:
          //console.log('victim is a '+victim.geometry.type);
        break;
      }
    }

    //If we've hit nothing, just keep on with the rotation logic
    if( !collision ) {
      container.addEventListener('mousemove', onMouseMove, false);
      container.addEventListener('mouseup', onMouseUp, false);
      container.addEventListener('mouseout', onMouseOut, false);

      targetOnDown.x = target.x;
      targetOnDown.y = target.y;

      container.style.cursor = 'move';
    }
  }

  function onMouseMove(event) {
    //the ACTUAL mouse
    mouse.x = - event.clientX;
    mouse.y = event.clientY;

    var zoomDamp = distance/1000;

    target.x = targetOnDown.x + (mouse.x - mouseOnDown.x) * 0.005 * zoomDamp;
    target.y = targetOnDown.y + (mouse.y - mouseOnDown.y) * 0.005 * zoomDamp;

    target.y = target.y > PI_HALF ? PI_HALF : target.y;
    target.y = target.y < - PI_HALF ? - PI_HALF : target.y;
  }

  function onMouseUp(event) {
    container.removeEventListener('mousemove', onMouseMove, false);
    container.removeEventListener('mouseup', onMouseUp, false);
    container.removeEventListener('mouseout', onMouseOut, false);
    container.style.cursor = 'auto';
  }

  function onMouseOut(event) {
    container.removeEventListener('mousemove', onMouseMove, false);
    container.removeEventListener('mouseup', onMouseUp, false);
    container.removeEventListener('mouseout', onMouseOut, false);
  }

  function onMouseWheel(event) {
    event.preventDefault();
    if (overRenderer) {
      zoom(event.wheelDeltaY * 0.3);
    }
    return false;
  }

  function onDocumentKeyDown(event) {
    switch (event.keyCode) {
      case 38:
        zoom(100);
        event.preventDefault();
        break;
      case 40:
        zoom(-100);
        event.preventDefault();
        break;
    }
  }

  function onWindowResize( event ) {
    camera.aspect = container.offsetWidth / container.offsetHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( container.offsetWidth, container.offsetHeight );
  }

  function zoom(delta) {
    distanceTarget -= delta;
    distanceTarget = distanceTarget > 1000 ? 1000 : distanceTarget;
    distanceTarget = distanceTarget < 350 ? 350 : distanceTarget;
  }

  function animate() {
    requestAnimationFrame(animate);
    render();
  }

  function render() {

    zoom(curZoomSpeed);

    rotation.x += (target.x - rotation.x) * 0.1;
    rotation.y += (target.y - rotation.y) * 0.1;
    distance += (distanceTarget - distance) * 0.3;

    camera.position.x = distance * Math.sin(rotation.x) * Math.cos(rotation.y);
    camera.position.y = distance * Math.sin(rotation.y);
    camera.position.z = distance * Math.cos(rotation.x) * Math.cos(rotation.y);

    camera.lookAt(mesh.position);

    renderer.render(scene, camera);
  }

  init();
  this.animate = animate;


  this.__defineGetter__('time', function() {
    return this._time || 0;
  });

  this.__defineSetter__('time', function(t) {
    var validMorphs = [];
    var morphDict = this.points.morphTargetDictionary;
    for(var k in morphDict) {
      if(k.indexOf('morphPadding') < 0) {
        validMorphs.push(morphDict[k]);
      }
    }
    validMorphs.sort();
    var l = validMorphs.length-1;
    var scaledt = t*l+1;
    var index = Math.floor(scaledt);
    for (i=0;i<validMorphs.length;i++) {
      this.points.morphTargetInfluences[validMorphs[i]] = 0;
    }
    var lastIndex = index - 1;
    var leftover = scaledt - index;
    if (lastIndex >= 0) {
      this.points.morphTargetInfluences[lastIndex] = 1 - leftover;
    }
    this.points.morphTargetInfluences[index] = leftover;
    this._time = t;
  });

  this.addData = addData;
  this.renderer = renderer;
  this.scene = scene;

  return this;

};