//scene.createDefaultCamera(true, true, true);
//scene.activeCamera.alpha += Math.PI;

// Parameters: name, alpha, beta, radius, target position, scene
var camera =  new BABYLON.ArcRotateCamera("Camera", 0, 0, -10, new BABYLON.Vector3(0, 0, 0), scene);
// Positions the camera overwriting alpha, beta, radius
camera.setPosition(new BABYLON.Vector3(30, 0, 30));
// This attaches the camera to the canvas
camera.attachControl(canvas, true);
camera.minZ = 0.05;

camera.lowerRadiusLimit = 44;
camera.upperRadiusLimit = 100;
camera.wheelDeltaPercentage = 0.01;
//var layer = new BABYLON.Layer('','https://fwlogistics.com/wp-content/uploads/2019/09/FWL_Sept_BlogImages_1_Warehouse.jpg', scene, true);
scene.clearColor = new BABYLON.Color3(0.95, 0.95, 0.95);

const assumedFramesPerSecond = 60;
const earthGravity = -9.81;
scene.gravity = new BABYLON.Vector3(0, earthGravity / assumedFramesPerSecond, 0);
//camera.ellipsoid = new BABYLON.Vector3(1, 1, 1);
scene.collisionsEnabled = true;
camera.checkCollisions = true;

camera.collisionRadius = new BABYLON.Vector3(0.5, 0.5, 0.5);
