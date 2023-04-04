if (getParameterByName('helix') !== null) {
    pathHelix = [];
    for (var i = 0; i <= 60; i++) {
        var v = 2.0 * Math.PI * i / 20;
        pathHelix.push(new BABYLON.Vector3(3 * Math.cos(v), i / 4, 3 * Math.sin(v)));
    }

    //Show single path
  /*  var lines = BABYLON.MeshBuilder.CreateLines("helixLines", {
        points : pathHelix
    }, scene);*/

    //Create the Ribbon around the single path
    var helix = BABYLON.MeshBuilder.CreateRibbon("helix", {
        pathArray : [pathHelix],
        offset : 20
    }, scene);
    helix.material = pvh;
    helix.material.backFaceCulling = false;
    
    
    helix.scaling ﻿= new BABYLON.Vector3(0.09,0.09,0.09);
    var direction = new BABYLON.Vector3(10, 0, 0);
            direction.normalize();
            helix.translate(direction, 1.7, BABYLON.Space.WORLD);
    
   
  //  lines.rotate(new BABYLON.Vector3(0, 0, 1), 1.58, BABYLON.Space.WORLD);
    helix.rotate(new BABYLON.Vector3(0, 0, 1), 1.58, BABYLON.Space.WORLD);

}

