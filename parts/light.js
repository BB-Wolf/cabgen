scene.clearColor = new BABYLON.Color3(0.7, 0.7, 0.7);

var light0 = new BABYLON.HemisphericLight("hemiLight", new BABYLON.Vector3(-1, 1, 0), scene);
light0.diffuse = new BABYLON.Color3(1, 1, 1);
light0.specular = new BABYLON.Color3(1, 1, 1);
//light0.groundColor = new BABYLON.Color3(1, 1, 1);

var light1 = new BABYLON.HemisphericLight("hemiLight", new BABYLON.Vector3(0, 1, 0), scene);
light1.diffuse = new BABYLON.Color3(1, 1, 1);
light1.specular = new BABYLON.Color3(1, 1, 1);
//light1.groundColor = new BABYLON.Color3(1,1, 1);  

var light2 = new BABYLON.HemisphericLight("hemiLight", new BABYLON.Vector3(-10, -10, -10), scene);
light2.diffuse = new BABYLON.Color3(1,1,1);
light2.specular = new BABYLON.Color3(1, 1, 1);
//light2.groundColor = new BABYLON.Color3(1, 1, 1);

