		// Set up the scene, camera, and renderer as global variables.
  	var renderer, scene, camera;
	var axes,object,marker;
	var WIDTH, HEIGHT;
	var distance1_init, distance2_init;
	var projector = new THREE.Projector();
	var directionVector = new THREE.Vector3();
	var raycaster = new THREE.Raycaster();
	var intersection;
	var initialisation_var;
	var echelle_init;
	var box_init,box;
	var distance;
	
	
	
  

    init();
	animate();
	
    // Init scene / object /camera / axes / lumière...
    function init() {
	
		var container = document.getElementById( 'container' );
		initialisation_var=0;
		echelle_init=0;
		
		WIDTH = window.innerWidth; //.clientWidth;
		HEIGHT = window.innerHeight;
		

		
		// Create the scene and set the scene size.
		scene = new THREE.Scene();
		
		// Create a camera, zoom it out from the model a bit, and add it to the scene.
		camera = new THREE.PerspectiveCamera(25, WIDTH / HEIGHT);
		camera.position.set(0,100,100);
		scene.add(camera);
		
		//Light
		var light = new THREE.AmbientLight( 0x404040,4 );
		scene.add( light );
		
		// Create a renderer and add it to the DOM.
		renderer = new THREE.WebGLRenderer({antialias:true});
		renderer.setSize(WIDTH, HEIGHT);
		container.appendChild( renderer.domElement );
		


		  // Si windows change de taille--> changer taille fenêtre WebGL
		window.addEventListener('resize', resize_render);
		
		//charger fichier DAE
		var loader = new THREE.ColladaLoader();
		loader.options.convertUpAxis = true;
		loader.load( 'drone.dae', function ( collada ) {
	    
			var objectProto = collada.scene;
			object = objectProto.clone();

			box_init = new THREE.Box3().setFromObject( object );
			object.position.x = 0
			object.position.y = -box_init.min.y; // le minimum du graphique
			object.position.z = 0;


			scene.add(object);
			
			axes = new THREE.AxisHelper(10);
			axes.position = object.position;
			scene.add(axes);
						
		});
		
		// Add OrbitControls so that we can pan around with the mouse.
		controls = new THREE.OrbitControls(camera, renderer.domElement);
		controls.zoomSpeed = 0.4;
	
	
		document.body.addEventListener('dblclick', double_click); // On crée l'événement lorsque double clique sur le "body" --> à remplacer par la où il y aura que la scene.	
    }
	
	// 
	function resize_render() {
		WIDTH = window.innerWidth; //.clientWidth;
		HEIGHT = window.innerHeight;
		renderer.setSize(WIDTH, HEIGHT);
		camera.aspect = WIDTH / HEIGHT;
		camera.updateProjectionMatrix();
		  }	
		
//supprimer les points sur l'object		
	function supprimer_points() {
	if (scene.children.length - 1 >= 4 )
			{
			//effacer tous les points
				var obj, i;
				for ( i = scene.children.length - 1; i >= 4 ; i -- )
				{
				obj = scene.children[ i ];
					scene.remove(obj);
				}
			}
	}
	
	// infos diverses
	 function info() {
		box = new THREE.Box3().setFromObject( object );
		console.log( box.min, box.max, box.size(), box , object.position.y);
	 }
	
	// action lorsque double clic (initialisation / distance / volume / création de points)
	function double_click()
	{
		var mouse = new THREE.Vector3();
		var raycaster = new THREE.Raycaster();
		
		mouse.x = ( event.clientX  / window.innerWidth ) * 2 -1 ;
		mouse.y = - ( event.clientY / window.innerHeight) * 2 +1 ;	
		
		
		// Now we set our direction vector to those initial values
		directionVector.set(mouse.x, mouse.y, 1);

		// Unproject the vector
		projector.unprojectVector(directionVector, camera);

		// Substract the vector representing the camera position
		directionVector.sub(camera.position);

		// Normalize the vector, to avoid large numbers from the
		// projection and substraction
		directionVector.normalize();

		// Now our direction vector holds the right numbers!
		raycaster.set(camera.position, directionVector);

		// Ask the raycaster for intersects with all objects in the scene:
		// (The second arguments means "recursive")
		var intersection = raycaster.intersectObjects(scene.children, true);

	  marker = new THREE.Mesh(new THREE.SphereGeometry(0.2), new THREE.MeshLambertMaterial({ color: 0xff0000 }));
	  scene.add(marker);
	  
	  
	  if (intersection.length) 
	  {
	   marker.position.x = intersection[0].point.x;
	   marker.position.y = intersection[0].point.y;
	   marker.position.z = intersection[0].point.z;
	   }
	   	   
	initialisation();
	
	mesure();
	
	 
  }
	
	//permet de détecter quand l'initialisation est enclenchée
	function initialisation_bouton()
	{
	
	alert("Début initialisation mise à niveau");
	if (echelle_init==0)
	{
		supprimer_points();
		echelle_init=1;
		initialisation_var=1;
	}
	else	
	{
	initialisation_var=2;
	}
	}
	
	//permet d'initialiser la première fois la taille + l'axe(origine et rotation des axes pour pouvoir suivre les parois), et les autres fois juste l'axe
	function initialisation()
	{
	if (initialisation_var==1)
	   {   
	   // vider tous les points qui existaient et paramétrer l'échelle
			if (echelle_init==1)
			{
				if (scene.children.length - 1 == 5 )
				{
					var distance = Math.sqrt(((scene.children[5].position.z-scene.children[4].position.z)*(scene.children[5].position.z-scene.children[4].position.z))+((scene.children[5].position.x-scene.children[4].position.x)*(scene.children[5].position.x-scene.children[4].position.x)));
					alert("ok :"+distance+" "+1.0/distance);
					
					object.scale.set(1/distance,1/distance,1/distance);
					
					axes.scale.set(1/distance,1/distance,1/distance);
					
					supprimer_points();
					camera.position.set(0,100,100);
					initialisation_var =2;
					echelle_init=2;

					box = new THREE.Box3().setFromObject( object );
					console.log( box.min, box.max, box.size(), box );
					
					object.position.y = - box.min.y -box_init.min.y; // le minimum du graphique; // le minimum du graphique
				}
				
			}
			
		}
			
	   else
		{
		//Positionner l'axe (origine)
		   if (initialisation_var==2)
		   {
			axes.position.x=0;
			axes.position.y=0;
			axes.position.z=0;
			axes.rotation.x=0;
			axes.rotation.y=0;
			axes.rotation.z=0;

			axes.position.x=marker.position.x;
			axes.position.y=marker.position.y;
			axes.position.z=marker.position.z;
			initialisation_var =3;
			
			scene.remove(marker);//effacer le point
			
			
		   }
		   else
		   {
				// Positionner correctement l'axe X (rotation selon Y)
			   if (initialisation_var==3)
			   {
					distance1_init=Math.abs(marker.position.x-axes.position.x);	
					distance2_init=Math.sqrt(((marker.position.x-axes.position.x)*(marker.position.x-axes.position.x))+((marker.position.z-axes.position.z)*(marker.position.z-axes.position.z)));

					if (axes.position.x>marker.position.x)
					{
					axes.rotateY(Math.acos(distance1_init/distance2_init));
					}
					else
					{
					axes.rotateY(-Math.acos(distance1_init/distance2_init));
					}
					initialisation_var=4;
					
			   }
			   else
			   {	   
			   // Positionner correctement l'axe Y (rotation selon X)
					if (initialisation_var==4)
					{
						alert("niveau 4");
						distance1_init=Math.abs(marker.position.z-axes.position.z);	
						distance2_init=Math.sqrt(((marker.position.z-axes.position.z)*(marker.position.z-axes.position.z))+((marker.position.y-axes.position.y)*(marker.position.y-axes.position.y)));
						alert(distance1_init +"   "+distance2_init);
						
						alert( marker.position.z);
						alert(( Math.acos(distance1_init/distance2_init)))
						alert((90-Math.acos(distance1_init/distance2_init)));
						alert((-90-Math.acos(distance1_init/distance2_init)));

						if (marker.position.y>0)
						{
						axes.rotateX(-(Math.acos(distance1_init/distance2_init)));
						alert("partie 1");
						}
						else
						{
						axes.rotateX((Math.acos(distance1_init/distance2_init)));
						alert("partie 2");
						}
						initialisation_var=5;
						//scene.remove(marker);//effacer le point
					}		   
			   }	   
		   }
	   }  
	}
	
	function mesure()
	{
	
	}
	
	
    // Renders the scene and updates the render as needed.
    function animate()
	{
      requestAnimationFrame(animate);
  
      // Render the scene.
      renderer.render(scene, camera);
      controls.update();
    }

