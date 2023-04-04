var zeroVector = new BABYLON.Vector3(0,0,0);
var rotateVectorMain = new BABYLON.Vector3(0, 90, 0);

var bodyMainCylinder;
var bodyDiameter = 4.5;
var bodyLength = bodyDiameter *2;
var bodyDiameterTop = bodyDiameter;
var bodyDiameterBottom = bodyDiameter;

var bodyDiameterOffset = 0;
var cableFillingLength = 1.5;
var cableFillingDiameter = bodyDiameter/2;
var cableFillingDiameterTop = cableFillingDiameter;
var cableFillingDiameterBottom = cableFillingDiameter;

var cableMetalLength = 1;
var cableMetalDiameter = cableFillingDiameter/1.5;
var cableMetalDiameterTop = cableMetalDiameter;
var cableMetalDiameterBottom = cableMetalDiameter;
var cableFillings = [];
var cutFillings = [];
var tubeFillings = [];
var totalCableFillings = 0;
var previewPic;


var createCableFilling = function(isCentered =0,cabFillLength=1.6,mat,diameter=bodyDiameter+0.1,
                                  diameterTop =bodyDiameter/2 ,diameterBottom =bodyDiameter/2,
                                  wrapWith,wrapMaterial=pvhPBRTextured,innerLine=0,positionX=0,positionY=0,positionZ=0,angle=0,cutMat= copperPBRTextured,storage = cableFillings,name="Оболочка жилы"){
    if(isCentered!=0) {
        diameterTop = diameter / 6;
        diameterBottom = diameter / 6;
        cabFillLength +=0.3;
    }

    var newCF = BABYLON.MeshBuilder.CreateCylinder(name, {
        height: cabFillLength,
        diameterTop : diameterTop,
        diameterBottom : diameterBottom,
        tessellation : 16,
        updatable: true
    }, scene);


  if(name!='Упрочняющий сердечник') {
      newCF.id = name + getRandomInt(1, 100000);
  }else{
      newCF.id = name;
  }
   // shadowGenerator.addShadowCaster(newCF, true);

    if(location.href.indexOf('lightShadows')!=-1) {
        shadowGenerator.addShadowCaster(newCF);
        shadowGenerator2.addShadowCaster(newCF);
        shadowGenerator3.addShadowCaster(newCF);
        shadowGenerator4.addShadowCaster(newCF);
        newCF.receiveShadows = true
    }

    if(location.href.indexOf('fullShadows')!=-1) {
        csmShadowGenerator.getShadowMap().renderList.push(newCF);
        csmShadowGenerator2.getShadowMap().renderList.push(newCF);
        csmShadowGenerator3.getShadowMap().renderList.push(newCF);
        csmShadowGenerator4.getShadowMap().renderList.push(newCF);
        newCF.receiveShadows = true;
    }

    newCF.checkCollisions = true;

    var isWrapped = 0;

    if(typeof mat === 'undefined' || mat =='')
    {
        if(totalCableFillings==0){ mat = plasticPBRGrey;}
        if(totalCableFillings==1){ mat =plasticPBRGrey;}
        if(totalCableFillings==2){ mat =plasticPBRGrey;}
        if(totalCableFillings>2){ mat = plasticPBRGrey;}
    }

    newCF.material = mat;
    newCF.lookAt(rotateVectorMain);
    if(isCentered!=0) {
        newCF.position.x = positionX;
        newCF.position.y =0;
    }else {
        newCF.position.x = positionX;
        newCF.position.y = positionY;
        newCF.position.z = positionZ;
    }

    if(wrapWith.indexOf('helix')!=-1) { wrapWithHelix(newCF,wrapMaterial,cabFillLength); isWrapped = 1; }
        var cfObj = {'object':newCF,'diameter':diameter,'diameterTop':diameterTop,'diameterBottom':diameterBottom,
    'material':mat, 'isWrapped':isWrapped,'innerLine':innerLine,
    'positionX':positionX,'positionY':positionY,'positionZ':positionZ};
    if(isCentered==0) {
        storage.push(cfObj);
    }
    totalCableFillings++;
}

var cableCuts = [];
var totalCableCuts = 0;


var getInnerCirlce = function(mainCircle,circle)
{
    let innerCirlce = mainCircle - circle;
     return innerCirlce;
}

var getAngle = function(count)
{
    let angleSteps = 360/count;
    return angleSteps;
}


var getCoords = function(radius,angle)
{
   var x = bodyLength * 1.6;
   var y = radius * Math.cos(angle * Math.PI/180);
   var z = radius * Math.sin(angle* Math.PI/180);

   var coords = {"x":x,"y":y,"z":z};

   return coords;
}

var coordinates = [];


function isMainFit(arrayOfObj,rad,elems)
{
    var effRad = rad;
    var newEffRad = 0;
    var angles = getAngle(elems);

    for(var i=0; i<arrayOfObj.length;i++)
    {
        newEffRad = newEffRad + (2*Math.PI * arrayOfObj[i].diameter);
    }

    if(newEffRad > bodyDiameter)
    {
        newEffRad = newEffRad + (newEffRad - bodyDiameter);
    }
      var nfr = newEffRad/ (2 * Math.PI);
      newEffRad = nfr/(elems/3);

    for(var objI=0;objI<arrayOfObj.length;objI++) {
        coords = getCoords(newEffRad/3,angles*objI);
        arrayOfObj[objI].object.position.z = coords.z;
        arrayOfObj[objI].object.position.y = coords.y;
    }
    bodyMainCylinder.dispose();
    createMainBody(bodyLength,newEffRad,newEffRad,newEffRad);

}

var buildCable = function(elemCount,elemRadius,rad,cablen,offset=1,inner=0)
{
    var angles = getAngle(elemCount);

   for(var k =0;k<elemCount;k++)
   {
       curAngle = angles * k + offset;
       elemCoords =  getCoords(rad,curAngle);
       coordinates.push(elemCoords);
       createCableFilling(0,cablen,'',elemRadius,elemRadius,elemRadius,'','',0,
           elemCoords.x,  elemCoords.y,  elemCoords.z,curAngle);
       if(inner==0){
           createTubes(10,innerElemsRadius/(elemCount*(1.1/innerElemsRadius)) ,10,'','',elemCoords.x/2.5,elemCoords.y,elemCoords.z,0.1);
       }else {
           createTubes(10,innerElemsRadius/(elemCount*(2.2/innerElemsRadius)),10,'','',elemCoords.x/1.4,elemCoords.y,elemCoords.z);
       }
   }
}


var isCableFit = function(firstElemZ,firstElemY,firstElemRad,nextElemZ,nextElemY,nextElemRad)
{
    var getSquare = (Math.pow( (nextElemZ-firstElemZ),2 )) + (( Math.pow( (nextElemY - firstElemY),2 )));
    var getRadSumm = firstElemRad + nextElemRad;

    if(getSquare <= getRadSumm)
    {
        return false;
    }else
    {
        return true;
    }
}

var createMainBody = function(length,diameter,diameterTop,diameterBottom,mat=blackPBRTextured,tessel = 64)
{
    bodyMainCylinder = BABYLON.MeshBuilder.CreateCylinder("Внешняя оболочка", {
        height : length*3,
        diameterTop : diameter,
        diameterBottom : diameter,
        tessellation : tessel
    }, scene);

    bodyMainCylinder.material = mat;
    bodyMainCylinder.lookAt(new BABYLON.Vector3(0, 90, 0));

    return bodyMainCylinder;
}

var reColorElems = function (element,mat) {

    if(typeof element == 'undefined' || element ==''){ return false;}
   if(element.hasOwnProperty('object'))
   {
       element.object.material = mat;
   }else {
       element.material = mat;
   }
}

var lastCoords =[];
var lastCoordsIter = 0;

var otherCurve = function(R,h,steps=10,mod = 1,startX=0,startY=0,startZ=0,curveStep=2,invert=0,skipStep=1,xMod = 0,yMod=0.38,zMod=0,curveMod = 3)
{
    var path = [];
    var x,y,z;
    lastCoords[lastCoordsIter] = [];
    if(curveMod == 0) { curveMod=1;} // ;)
    for(var i =skipStep;i<=steps; i+=mod)
    {
        if(invert==0) {
            y = R * Math.sin(i/curveMod);
            z = R * Math.cos(i/curveMod);
        }else {
            y = R * Math.cos(i/curveMod);
            z = R * Math.sin(i/curveMod);
        }
        x = h*i*curveStep+xMod;
        z= z+0.2+zMod;
        y= y+yMod;
       path.push(new BABYLON.Vector3(x,y,z));
       lastCoords[lastCoordsIter].push(new BABYLON.Vector3(x,y,z));
    }
lastCoordsIter+=1;

    return path;
}

var linearCurve = function(x=5){ return [new BABYLON.Vector3(0,0,0), new BABYLON.Vector3(x,0,0)];};

var tube;

var createTubes = function(count,radius = 0.2,steps=5,mod=0.5,mat = copperPBRTextured,positionX,positionY,positionZ,innerRad = 0.21,length=3,path,invert=0,skipStep=1)
{
    var newInstance;
    if(typeof path == 'undefined' || path=='')
    {
       path =  otherCurve( innerRad, length, steps, mod,0,0,0,2);
    }
    for(var i=skipStep; i<=count;i++)
    {
        if(i==1) {
            tube = BABYLON.MeshBuilder.CreateTube("Токопроводящая жила", {
                path: path,
                radius: radius,
                sideOrientation: BABYLON.Mesh.DOUBLESIDE,
                updatable: true,
                cap: BABYLON.Mesh.CAP_ALL,
                tesselation: 64
            }, scene);
        tube.material = copperPBRTextured;
        tube.id = 'tubeId';
            tube.position.x = positionX;
            tube.position.y = positionY
            tube.position.z =positionZ;
            tube.rotation.x = i;
            tube.name = "Токопроводящая жила";
        }

        newInstance = tube.createInstance("Токопроводящая жила" + getRandomInt(1,1000000000));
        newInstance.position.x = positionX;
        newInstance.position.y = positionY
        newInstance.position.z =positionZ;

        newInstance.rotation.x = i;
        newInstance.name = "Токопроводящая жила";
        newInstance.thinInstanceEnablePicking = true;
    }

}


var createTubesUnOpt = function(name="Токопроводящая жила",count,radius = 0.2,steps=5,mod=0.5,mat = copperPBRTextured,positionX,positionY,positionZ,innerRad = 0.21,length=3,invert=0,skipStep=1,curveStep=2,xMod=0,yMod=0.38,zMod=0,path,bdm,storage=[],curveMod=3)
{

    if(typeof path == 'undefined' || path=='') {
         path = otherCurve(innerRad, length, steps, mod, 0, 0, 0, curveStep, invert, skipStep, xMod, yMod,zMod,curveMod);
    }

    var agl = getAngle(count);

    for(var i=1; i<=count;i++) {
        tube = BABYLON.MeshBuilder.CreateTube(name, {
            path: path,
            radius: radius,
            sideOrientation: BABYLON.Mesh.DOUBLESIDE,
            updatable: true,
            cap: BABYLON.Mesh.CAP_ALL,
            tesselation: 16
        }, scene);

        tube.cullingStrategy = BABYLON.AbstractMesh.CULLINGSTRATEGY_OPTIMISTIC_INCLUSION;
        tube.material = mat;
        if(name == '' ){
            tube.name = 'Токопроводящая жила';
        }
        tube.id = tube.id+getRandomInt(1,100000000000000);
        if(tube.name=='Токопроводящая жила') {
            tube.checkCollisions = false;
        }else
        {
            tube.checkCollisions = true;
        }

        if(typeof storage!='boolean'){
            storage.push(tube);}

        if(location.href.indexOf('lightShadows')!=-1) {
            shadowGenerator.addShadowCaster(tube);
            shadowGenerator2.addShadowCaster(tube);
            shadowGenerator3.addShadowCaster(tube);
            shadowGenerator4.addShadowCaster(tube);
            tube.receiveShadows = true
        }

        if(location.href.indexOf('fullShadows')!=-1) {
            csmShadowGenerator.getShadowMap().renderList.push(tube);
            csmShadowGenerator2.getShadowMap().renderList.push(tube);
            csmShadowGenerator3.getShadowMap().renderList.push(tube);
            csmShadowGenerator4.getShadowMap().renderList.push(tube);
            tube.receiveShadows = true;
        }
        var rad = getCoords(bdm,agl*i);

        if(bdm==0 || typeof bdm === 'undefined' || bdm =='')
        {
            tube.position.x = positionX;
            tube.position.y = positionY;
            tube.position.z = positionZ;

        }else {
            tube.position.x = positionX;
            tube.position.y = rad.y;
            tube.position.z = rad.z;
        }
        if(count>3 && count<8) {
            tube.rotation.x = i*1.3;
          //  tube.rotation.x+= getRandomInt(3,10);
        }
        if(count == 4)
        {
            tube.rotation.x = i* 1.5;
        }

        if(count == 6)
        {
            tube.rotation.x = i * 1.1;
        }

        if(count==7) {
             tube.rotation.x = i*0.9;
        }
        if(count==8) {
             tube.rotation.x = i *0.8;
        }
         if (count<=3) {
            tube.rotation.x = i*2.2;
        }
         if(count>=9 && count<12){
            tube.rotation.x = i*0.7;
        }

         if(count == 10){
             tube.rotation.x = i* 0.62;
         }
         if(count==12){
            tube.rotation.x = i * 0.52;
        }


   //   tube.rotation.x+=rad.x;
     //   tube.name = "Токопроводящая жила";
        tube.freezeWorldMatrix();

    }

}
