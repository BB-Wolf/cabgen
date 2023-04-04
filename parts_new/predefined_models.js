var createHelix = function(helixMaterial = pvhPBRTextured,objectDiameter =0.3,offset = 20,helixPositionX = 0, helixPositionY = 0,helixPositionZ=0,stepLen = 50,name="Сепаратор по скрученным жилам",scaleParam) {
    pathHelix = [];
    for (var i = 0; i <= stepLen; i++) {
        var v = 2.0 * Math.PI * i / 20;
        pathHelix.push(new BABYLON.Vector3(3 * Math.cos(v), i / 4, 3 * Math.sin(v)));
    }

    var helix = BABYLON.MeshBuilder.CreateRibbon(name, {
        pathArray : [pathHelix],
        offset : offset
    }, scene);
    helix.id = helix.name + getRandomInt(1,100000);
    helix.material = helixMaterial;
    helix.material.backFaceCulling = false;

    if(location.href.indexOf('lightShadows')!=-1) {
        shadowGenerator.addShadowCaster(helix);
        shadowGenerator2.addShadowCaster(helix);
        shadowGenerator3.addShadowCaster(helix);
        shadowGenerator4.addShadowCaster(helix);

    }

    if(location.href.indexOf('fullShadows')!=-1) {
        csmShadowGenerator.getShadowMap().renderList.push(helix);
        csmShadowGenerator2.getShadowMap().renderList.push(helix);
        csmShadowGenerator3.getShadowMap().renderList.push(helix);
        csmShadowGenerator4.getShadowMap().renderList.push(helix);

    }


    if(scaleParam=='' || typeof scaleParam==='undefined') {
        var scaleParam = (objectDiameter / 1.55) - objectDiameter / stepLen;
    }
    helix.scaling ﻿= new BABYLON.Vector3(scaleParam,scaleParam,scaleParam);
    var direction = new BABYLON.Vector3(helixPositionX, helixPositionY/1.22, helixPositionZ);
    direction.normalize();
    helix.position.x = helixPositionX/1.7;
    helix.position.y = helixPositionY;
    helix.position.z = helixPositionZ;
    helix.translate(direction, 1, BABYLON.Space.WORLD);
    helix.rotate(new BABYLON.Vector3(0, 0, 1), 1.58, BABYLON.Space.WORLD);

    helix.freezeWorldMatrix();

}


var wrapWithHelix = function(object,material,cablen,diameter,ofst,)
{

    var helixPositionX = object.position.x + (cablen*1.07);
    var helixPositionY = object.position.y;
    var helixPositionZ = object.position.z;
    createHelix(material,diameter,ofst,helixPositionX,helixPositionY,helixPositionZ);
}