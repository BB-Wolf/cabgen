//var camera = new BABYLON.ArcRotateCamera("Camera", -Math.PI / 4, Math.PI / 2.5, 300, BABYLON.Vector3.Zero(), scene);
  var camera = new BABYLON.UniversalCamera("camera", new BABYLON.Vector3(-100, 0, -10), scene);
  camera.setTarget(BABYLON.Vector3.Zero());
  camera.attachControl(canvas, true);

// scene.imageProcessingConfiguration.exposure = 1.0;
// scene.imageProcessingConfiguration.contrast = 1.1;
// create a basic light, aiming 0,1,0 - meaning, to the sky

        /*  var hdrSkybox = BABYLON.Mesh.CreateBox("hdrSkyBox", 1000.0, scene);
var hdrSkyboxMaterial = new BABYLON.StandardMaterial("skyBox", scene);
hdrSkyboxMaterial.backFaceCulling = false;
hdrSkyboxMaterial.diffuseColor = new BABYLON.Color3(1, 1, 1);
hdrSkyboxMaterial.specularColor = new BABYLON.Color3(1, 1,1);
hdrSkyboxMaterial.groundColor = new BABYLON.Color3(1, 1, 1);
hdrSkyboxMaterial.disableLighting = false;
hdrSkybox.material = hdrSkyboxMaterial;
hdrSkybox.infiniteDistance = true;*/



pointLight = new BABYLON.PointLight("point1", new BABYLON.Vector3(0,1,0), scene);
pointLight.intensity=0.00;
pointLight.specularColor = new BABYLON.Color3(0.05,0.05,0.05);
pointLight.diffuseColor =  new BABYLON.Color3(0.3,0.3,0.3);

/*
var shadowGenerator = new BABYLON.ShadowGenerator(1024, pointLight);
*/