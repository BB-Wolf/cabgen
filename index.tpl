<? include("../compiler.php");?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <title>Кабель-генератор</title>
        <!--- Link to the last version of BabylonJS --->
        <script src="https://cdn.babylonjs.com/babylon.js"></script>
        <script src="https://cdn.babylonjs.com/loaders/babylonjs.loaders.min.js"></script>
        <script src="https://cdn.babylonjs.com/gui/babylon.gui.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>
        <link rel="preload" href="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.css" as="style">
<!--
        <script src="../../js/babylon.js"></script>
        
         <script src="../../js/babylonjs.loaders.min.js"></script>
        <script src="../../js/babylon.gui.min.js"></script>-->
        <script src="../../js/ammo.js"></script>

        <style>	
            html, body {
                overflow: hidden;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            #renderCanvas {
                width: 100%;
                height: 100%;
                touch-action: none;
            }
            #my-loader
            {
            width:100%;
            height:100%;
            position:fixed;
            top:0;
            background:black;
                display: none;
            }

            #my-loader img
            {
                display: table-cell;
                height: 300px;
                text-align: center;
                width: 300px;
                vertical-align: middle;
                margin: 0 auto;
            }
            #fps {
                position: absolute;
                background-color: black;
                border: 2px solid red;
                text-align: center;
                font-size: 16px;
                color: white;
                top: 15px;
                right: 10px;
                width: 60px;
                height: 20px;
            }

        </style>
        <script>
            var ldld = new ldLoader({ root: "#my-loader" });
            /* 4. active this loader */
            ldld.on();
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
             setTimeout(function(){ document.getElementById('my-loader').remove();},7000);
            });
        </script>
    </head>
    <body>
    <div id="my-loader" class="loader">
        <img src="http://cablegen.sianlab.site/Infinity-1s-200px (1).svg">
    </div>
    <div id="fps">0</div>
    <div id="info" style="position: absolute; width:auto;top:5vh; left:45%; height:auto; padding: 20px; display: none; background-color: #336699; border-color: #336699;    color: #ffffff;"></div>
        <canvas id="renderCanvas"></canvas>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                let divFps = document.getElementById("fps");
				   <none_babylon_functions>

					var canvas = document.getElementById('renderCanvas');
                   if(location.href.indexOf('doScreen')==-1) {
                       var engine = new BABYLON.Engine(canvas, true,null);
                   }else {
                       var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true });
                   }

					// createScene function that creates and return the scene
                    var cv=0;
					var delayCreateScene = function() {
						// Create a scene.
						var scene = new BABYLON.Scene(engine);
					//	scene.enablePhysics();
                        var highLight;
                        var prevHighLight;
                        scene.autoClear = false; // Color buffer
                        scene.autoClearDepthAndStencil = false; // Depth and stencil, obviously
                        scene.blockMaterialDirtyMechanism = true;
                        scene.getAnimationRatio();

                    <materials>
                    <variables>

						<camera_and_skybox>               
				   
				  							 
				 
				  <light>
				  

				  
				  <predefined_models>	

										  
				  <presets>    
				  
				  <settings_and_defaults>
						
				  <action_code>
				  
                    
                    //     camera.setPosition(new BABYLON.Vector3(0, 0, 5));
                    return scene;
                };

                var doonce =0 ;
                // call the createScene function
                var scene = delayCreateScene();


                // run the render loop


                engine.runRenderLoop(function() {
                    scene.render();

                    divFps.innerHTML = engine.getFps().toFixed() + " fps";
                    // dCR.render();
                });



                // the canvas/window resize event handler
                window.addEventListener('resize', function() {
                    engine.resize();
                });

            });
        </script>
    </body>
</html>