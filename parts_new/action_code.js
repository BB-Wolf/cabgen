var elemsFirstRow = 10;
var elemsSecondRow = 9;
var innerElemsRadius = 1.5;

var innerElements = 2;
var radiusModifier = 2.76;

var noAddHelix;


var firstRowMaterial,secondRowMaterial,globalFillMaterial ;
var centerCutMaterial,centerCutFillingMaterial;
var isCentered = 0;

if(getUriParam('firstRow',location.href))
{
 elemsFirstRow = getUriParam('firstRow',location.href);
}
if(getUriParam('secondRow',location.href))
{
 elemsSecondRow =  getUriParam('secondRow',location.href);
}


var parseUri = function(vl,alias)
{
 vlOld = vl;
 if(typeof alias == 'undefined' && alias!='') {
   if (getUriParam(vl, location.href)) {
    vl = eval(getUriParam(vl, location.href));
    return vl;
   } else {
    vl = eval(vlOld);
    return vl;
   }
 }else {
  if (getUriParam(alias, location.href)) {
   vl = eval(getUriParam(alias, location.href));
   return vl;
  } else {
   vl = eval(vlOld);
   return vl;
  }
 }
}

globalFillMaterial =  parseUri('globalFillMaterial');
firstRowMaterial = parseUri('firstRowMaterial','fRowMat');
secondRowMaterial = parseUri('secondRowMaterial','sRowMat');

if(typeof globalFillMaterial!='undefined' && globalFillMaterial!='')
{
  firstRowMaterial = globalFillMaterial;
  secondRowMaterial  = globalFillMaterial;
}
if(getUriParam('bodyMainDiameter',location.href))
{
 bodyDiameter = getUriParam('bodyMainDiameter',location.href);
 bodyDiameterTop = getUriParam('bodyMainDiameter',location.href);
 bodyDiameterBottom = getUriParam('bodyMainDiameter',location.href);
}

bodyLength = parseUri('bodyLength');
bodyMaterial = blackPBRTextured;
bodyMaterial = parseUri('bodyMaterial');


if(getUriParam('innerElemsRadius',location.href))
{
  innerElemsRadius = getUriParam('innerElemsRadius',location.href);
}


frameRotate = 60;
frameRotate = parseUri('frameRotate');
camera.setPosition(new BABYLON.Vector3(frameRotate, 0, frameRotate));


if(location.href.indexOf('doScreen')!=-1) {
 scene.afterRender = function () {

  doonce++;
  if (doonce == 60) {
   camera.setPosition(new BABYLON.Vector3(60, 0, 60));
   camera.radius = 40;
   camera.alpha = 120;
// Positions the camera overwriting alpha, beta, radius
  }
  if (doonce == 62) {
   BABYLON.Tools.CreateScreenshot(engine, camera, {width: 800, height: 400}, function (data) {
    previewPic = data;
   });
   // $.post('savepic.php', {name:'cab1',picfile:previewPic})
   var xhr = new XMLHttpRequest();
   if(typeof secondBody==='undefined') { secondBody='nb';}
   if(typeof noAddHelix==='undefined') { noAddHelix='na';}
   xhr.open('POST', '../../savepic.php', true);
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send("name="+getTotalElems+""+innerElemsRadius+""+secondBody+""+noAddHelix+"&picfile=" + previewPic);
  }
  if (doonce == 63) {
   camera.setPosition(new BABYLON.Vector3(60, 0, 60));
  }
 }
}


if(location.href.indexOf('debug')!=-1) {
 scene.debugLayer.show({showExplorer: true, embedMode: true}).then(() => {
 });
}

var getTotalElems, buildElemsDiameter;

getTotalElems = 19;
getTotalElems = parseUri('getTotalElems');

var buildRows = function(elemsToCut)
{
    var elemsLeft = elemsToCut;
    var buildRow = new Array();
    var rows = 0;
    var it = 0;
    while(elemsLeft>0) {
        it++;
        if(it>=12) { buildRow[rows] = it;  it = 0; rows = rows + 1;}
        if(elemsLeft<=1){ buildRow[rows] = it++;}
        elemsLeft--;
    }
    return buildRow;
}

var getRowsToBuild = buildRows(getTotalElems);

var options = [];


if(innerElemsRadius==1.5){buildElemsDiameter=0.6;}
if(innerElemsRadius==2.5){buildElemsDiameter=1;}

var opts = [];
opts[1.5] = {
    '19':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
}],
    '12':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
    }],
    '9':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}],
    '7':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}]


};


opts[2.5] = {
    '19':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
    }],
    '12':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
    }],
    '9':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}],
    '7':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}]


};

if(innerElemsRadius == 1.5)
{
    options =
        {
            'length':3,
            'radius':buildElemsDiameter,
            'innerElemsRadius':buildElemsDiameter-0.3,
            'material':plasticPBRGrey,
            'cutmaterial':copperPBRTextured,
            'mod':0.1,
            'innerRadBase':1.3,
            'innerRad':1.009,
            'bodyMod':3.7,
            'helixDiameter':0,
            'secondHelixDiameter':0,
            'secondBodyDiameter':0,
            'skipStep':0,
            'xMod':0,
            'yMod':0.38,
            'zMod':0,
            'fixX':0,
            'fixY': 0,
            'fixZ': 0,
            'invertFirstRow': 1,
            'invertSecondRow':0,
            'initLength': 6.25,
            'initLengthMod':0.95,
            'initCutLength':6.45,
            'initCutLengthMod': 0.95
        };
}

if(innerElemsRadius == 2.5)
{
    options =
        {
            'length':3,
            'radius':buildElemsDiameter,
            'innerElemsRadius':buildElemsDiameter-0.3,
            'material':plasticPBRGrey,
            'cutmaterial':copperPBRTextured,
            'mod':0.1,
            'innerRadBase':2.2,
            'innerRad':2,
            'bodyMod':5.6,
            'helixDiameter':0,
            'secondHelixDiameter':0,
            'secondBodyDiameter':0,
            'xMod':0,
            'yMod':0.39,
            'zMod':0,
            'fixX':0,
            'fixY': 0,
            'fixZ': 0,
            'invert': 0,
            'invertFirstRow': 1,
            'invertSecondRow':0,
            'initLength': 6.25,
            'initLengthMod':0.95,
            'initCutLength':6.45,
            'initCutLengthMod': 0.95
        };
}


var scaleParamFix;
var helixDiameter = 1;

var bodyResultDiameter = 0;

if(getTotalElems<9 && innerElemsRadius!=2.5) {
    bodyResultDiameter = Math.ceil(4 * getRowsToBuild.length);
}else if(getTotalElems<9 && innerElemsRadius==2.5)
{
    bodyResultDiameter = Math.ceil(3.6 * getRowsToBuild.length);
}else {
    bodyResultDiameter = Math.ceil(options.bodyMod * getRowsToBuild.length) + 0.5;
}


if(getTotalElems>12){
getRowsToBuild = getRowsToBuild.reverse();
}

if(getTotalElems==9) {
    getRowsToBuild = [5,4];
}

if(getTotalElems==12) {
    getRowsToBuild = [2,10];
}

if(innerElemsRadius==1.5) {
    helixDiameter = 1.96;
}else {
    helixDiameter = 2.86;
}

for(var i=0; i<getRowsToBuild.length;i++) {

    if(getTotalElems == 7)
    {
        options.innerRad = 0.6;
        options.innerRadBase = 0.8;
        options.yMod = 0.53;
        options.initLength = 4.45;
        options.initCutLength = 4.85;
    }

    if(getTotalElems == 7 && innerElemsRadius ==2.5)
    {
        options.innerRad = 1.8;
        options.innerRadBase = 1.8;
        options.yMod = 0.53;
        bodyResultDiameter += 0.7;
    }

    if (getTotalElems == 9) {
        helixDiameter = 0.8;
        scaleParamFix = 0.9;
        bodyResultDiameter +=-0;
        options.innerRad = 0.52;
        options.innerRadBase = 1;
        options.skipStep = 1;
        if(i==1) {
            options.yMod = 0.68;
            options.zMod = -1;
        }
    }

    if (getTotalElems == 12) {
        helixDiameter = 0.35;
        scaleParamFix = 0.35;
        bodyResultDiameter -= 1.;
        options.innerRad = 0.99;
        options.innerRadBase = 0.99;
        options.skipStep = 1;


        if (i == 0) {
          //  options.zMod = -0.28;
            options.yMod =  0.08
            options.invert = 1;
        }else{
            options.yMod = 0.38;
        }
    }


    if(getTotalElems==12 && innerElemsRadius == 2.5)
    {
        options.innerRad = 1.8;
        options.innerRadBase = 1.8;
    }


    if (getTotalElems == 9 && innerElemsRadius == 2.5) {
        options.innerRad = 1.25;
        options.innerRadBase = 2.05;
        bodyResultDiameter+=1;
        if (i == 0) {
            //  options.zMod = -0.28;
            options.yMod =  0.38
            options.invert = 1;
        }else{
            options.yMod = 0.38;
        }
        options.skipStep = 2;
        options.length = 2.5
    }
    if (getTotalElems == 7 && innerElemsRadius == 2.5) {
        options.zMod = 0;
        bodyResultDiameter += 1.5;
        options.skipStep = 2;
    }
    if(getTotalElems>7) {
        if (i == 0) {
            options.invert = options.invertFirstRow;
        } else {
            options.invert = options.invertSecondRow;
        }
    }
    if (getTotalElems != 12 && getTotalElems!=9) {
        createTubesUnOpt("Оболочка жилы",getRowsToBuild[i], options.radius, options.initLength - (i * options.initLengthMod), options.mod, options.material, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, options.skipStep, 2, options.xMod, options.yMod, options.zMod, '','',tubeFillings);
         if(innerElemsRadius==1.5) {
           var gtc = getAngle(10);
           for (var gcc = 0; gcc <= 10; gcc++) {
               var gco = getCoords(0.1, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
               var gco = getCoords(0.2, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
       }else {
           var gtc = getAngle(5);
           for (var gcc = 0; gcc <= 5; gcc++) {
               var gco = getCoords(0.1, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
           var gtc = getAngle(10);
           for (var gcc = 0; gcc <= 10; gcc++) {
               var gco = getCoords(0.2, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
           var gtc = getAngle(20);
           for (var gcc = 0; gcc <= 20; gcc++) {
               var gco = getCoords(0.35, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
       }
    } else {
        if(innerElemsRadius==1.5){ options.initLength = 4.45; options.initCutLength=4.95;}
        if(innerElemsRadius==2.5){ options.initLength = 5.55; options.initCutLength=6.05;}
        if(getTotalElems==12 && innerElemsRadius==1.5){ options.initLength = 4.45; options.initCutLength=4.95;}
        if(getTotalElems==12 && innerElemsRadius==2.5){ options.initLength = 4.55; options.initCutLength=5.05;}
        createTubesUnOpt('Оболочка жилы',getRowsToBuild[i], options.radius, options.initLength, options.mod, options.material, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, options.skipStep, 2, options.xMod, options.yMod, options.zMod, '','',tubeFillings);

        if(innerElemsRadius==1.5) {
            var gtc = getAngle(10);
            for (var gcc = 0; gcc <= 10; gcc++) {
                var gco = getCoords(0.1, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
                var gco = getCoords(0.2, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
        }else {
            var gtc = getAngle(5);
            for (var gcc = 0; gcc <= 5; gcc++) {
                var gco = getCoords(0.1, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
            var gtc = getAngle(10);
            for (var gcc = 0; gcc <= 10; gcc++) {
                var gco = getCoords(0.2, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
            var gtc = getAngle(20);
            for (var gcc = 0; gcc <= 20; gcc++) {
                var gco = getCoords(0.35, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
        }
    }
}

if(getTotalElems!=9 && innerElemsRadius!=2.5){
    helixDiameter = helixDiameter - ((19 - getTotalElems)/10);
}else {
    helixDiameter = Math.ceil(helixDiameter - ((19 - getTotalElems)/10));
}

if(!getUriParam('secondBody',location.href)){
    var scaleParamFix = 1.25
    if(innerElemsRadius==2.5 && getTotalElems==19)
    {
        scaleParamFix = 1.95;
    }
    if(getTotalElems==7){ helixDiameter = 0.8; scaleParamFix = 0.9; bodyResultDiameter +=1.8; options.innerRad = 1.1; options.innerRadBase = 1.2; options.skipStep=1; }
    if(getTotalElems==9){ helixDiameter = 0.8; scaleParamFix = 1; bodyResultDiameter +=1.9; options.innerRad = 1.5; options.innerRadBase = 1.3; options.skipStep=1; options.zMod =0.9;}
    if(getTotalElems==9 && innerElemsRadius == 2.5) { scaleParamFix = 1.8; bodyResultDiameter+=1.15;}
    if(getTotalElems==7 && innerElemsRadius == 2.5) { scaleParamFix = 1.2;}
    if(getTotalElems==12) { scaleParamFix = 1.11; bodyResultDiameter+=1;}
    if(getTotalElems==12 && innerElemsRadius == 2.5) { scaleParamFix = 1.75; bodyResultDiameter+=1;}
    options.bodyLengthMod = 3.5;
    options.bodyPosFix = -2;

    if(innerElemsRadius==2.5)
    {
        options.bodyLengthMod= 1.8;
        options.bodyPosFix = -10;
    }
    if(getTotalElems==7)    {options.bodyPosFix = 4;}
    if(getTotalElems==7 && innerElemsRadius==2.5)  {options.bodyPosFix = 2;}

    if(getTotalElems==9) { options.bodyPosFix=2;}
    if(getTotalElems==9 && innerElemsRadius==2.5) { options.bodyPosFix=-9;}
    createCableFilling(0, bodyResultDiameter*innerElemsRadius*options.bodyLengthMod, bodyMaterial, bodyResultDiameter, bodyResultDiameter, bodyResultDiameter, '', '', '',
        options.bodyPosFix, 0, 0, '', '', cableFillings, 'Оболочка кабеля');
    createHelix(plenkaPBRTextured, helixDiameter, 20, 40, 0, 0, 50,'Сепаратор по скрученным жилам',scaleParamFix);
}else {
    var cablePosX = -17;
    var cableAddPosX = 4;
    var fillPosX = 28;
    var fillAddPosX = 42;

    if(getTotalElems==19 && innerElemsRadius==2.5){
        cablePosX = -25;
        cableAddPosX = -1.7;
        fillPosX = 16;
        fillAddPosX = 35;
        bodyResultDiameter+=2;
    }
    if(getTotalElems==19 && innerElemsRadius==1.5){bodyResultDiameter+=2; }
    if(getTotalElems == 7) { bodyResultDiameter+=1;}
    if(getTotalElems==7 && innerElemsRadius==2.5){bodyResultDiameter+=2; }
    if(getTotalElems==9 && innerElemsRadius==1.5){bodyResultDiameter+=2.28;scaleParamFix+=0.1 }
    if(getTotalElems==9 && innerElemsRadius==2.5){bodyResultDiameter+=3; scaleParamFix=1.63; }
   if(getTotalElems==12) { scaleParamFix = 1.1; bodyResultDiameter+=1;}
    if(getTotalElems==12 && innerElemsRadius == 2.5) { scaleParamFix = 1.73; bodyResultDiameter+=1;}

    createCableFilling(0, 60, bodyMaterial, bodyResultDiameter+0.55, bodyResultDiameter+0.55, bodyResultDiameter+0.55, '', '', '',
        cablePosX, 0, 0, '', '', cableFillings, 'Оболочка кабеля');
    if(getTotalElems==7 && innerElemsRadius==2.5){helixDiameter -=0.52;}

  if(parseUri('noAddHelix')!=1) {
      createHelix(blackLightPBRTexturedHelix, helixDiameter + 0.38, 20, fillAddPosX, 0, 0, 50, 'Лента из прорезиненной ткани ', scaleParamFix);
  }else {
      createHelix(blackLightPBRTexturedHelix, helixDiameter + 0.38, 20, fillAddPosX, 0, 0, 50, 'Сепаратор по скрученным жилам ', scaleParamFix);
  }

    if(getTotalElems==7 && innerElemsRadius==1.5)    { helixDiameter += 0.34; }
    if(getTotalElems==7 && innerElemsRadius==2.5){helixDiameter +=0.64;}
    if(getTotalElems==9 && innerElemsRadius==1.5){scaleParamFix=1.1;}
    if(getTotalElems==9 && innerElemsRadius==2.5){scaleParamFix=1.91;}
    if(getTotalElems==19 && innerElemsRadius==1.5){scaleParamFix=1.7; }
    if(getTotalElems==19 && innerElemsRadius == 2.5) { scaleParamFix = 2.39;}
    if(getTotalElems==12) { scaleParamFix = 1.2;}
    if(getTotalElems==12 && innerElemsRadius == 2.5) { scaleParamFix = 2.09; bodyResultDiameter+=0;}

    if(parseUri('noAddHelix')!=1) {
        createHelix(plenkaPBRTextured, helixDiameter + 0.34, 20, fillPosX, 0, 0, 40, 'Сепаратор по скрученным жилам', scaleParamFix);
    }
    if(parseUri('noAddHelix')!=1) {
        createCableFilling(0, 33, blackLightPBRTextured, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, '', '', '',
            cableAddPosX, 0, 0, '', '', cableFillings, 'Дополнительная оболочка');
    }else {
        createCableFilling(0, 33, blackPBRTextured, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, '', '', '',
            cableAddPosX, 0, 0, '', '', cableFillings, 'Дополнительная оболочка');
    }
}

// ############################################################################################# ///

if(getTotalElems>12) {
    createCableFilling(0, 40, blackLightPBRTextured, innerElemsRadius - 0.3, innerElemsRadius - 0.3, innerElemsRadius - 0.3, '', '', '',
        20, 0, 0, '', '', cableFillings, 'Изоляция упрочняющего сердечника');
    createCableFilling(0, 43, ropePBR, innerElemsRadius - 0.6, innerElemsRadius - 0.6, innerElemsRadius - 0.6, '', '', '',
        20, 0, 0, '', '', cableFillings, 'Упрочняющий сердечник');
}else
{
    if(innerElemsRadius==1.5) {
        createCableFilling(0, 20, blackLightPBRTextured, innerElemsRadius - 0.3, innerElemsRadius - 0.3, innerElemsRadius - 0.3, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Изоляция упрочняющего сердечника');
        createCableFilling(0, 23, ropePBR, innerElemsRadius - 0.6, innerElemsRadius - 0.6, innerElemsRadius - 0.6, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Упрочняющий сердечник');
    }else {
        createCableFilling(0, 25, blackLightPBRTextured, innerElemsRadius - 0.3, innerElemsRadius - 0.3, innerElemsRadius - 0.3, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Изоляция упрочняющего сердечника');
        createCableFilling(0, 28, ropePBR, innerElemsRadius - 0.6, innerElemsRadius - 0.6, innerElemsRadius - 0.6, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Упрочняющий сердечник');
    }
}


if(getTotalElems>10) {
    for (var randRecolor = 0; randRecolor < 3; randRecolor++) {
        reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRLightBlue);
        reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRPink);
    }
    reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRGround);
}
if(getTotalElems<=10){
    for (var randRecolor = 0; randRecolor < 2; randRecolor++) {
        reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRLightBlue);
    }
    reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRGround);
}

var pipeLineSamples = 1;
pipeLineSamples = parseUri('pipeLineSamples');

var needFXAA = false;
needFXAA = parseUri('needFXAA');
if(needFXAA==0)
{
    needFXAA = false;
}else {
    needFXAA = true;
}

var pipeline = new BABYLON.DefaultRenderingPipeline(
    "defaultPipeline", // The name of the pipeline
    true, // Do you want the pipeline to use HDR texture?
    scene, // The scene instance
    [camera] // The list of cameras to be attached to
);
pipeline.samples = pipeLineSamples;
pipeline.bloomEnabled = true;
pipeline.bloomThreshold = 0.6;
pipeline.bloomWeight = 0.05;
pipeline.bloomKernel = 2;
pipeline.bloomScale = 0.5;
pipeline.fxaaEnabled = needFXAA;


pipeline.depthOfFieldEnabled = false;
pipeline.depthOfFieldBlurLevel = BABYLON.DepthOfFieldEffectBlurLevel.Low;

pipeline.depthOfField.focusDistance  = 3094.3; // distance of the current focus point from the camera in millimeters considering 1 scene unit is 1 meter
pipeline.depthOfField.focalLength  = 225.5; // focal length of the camera in millimeters
pipeline.depthOfField.fStop  = 23.7; // aka F number of the camera defined in stops as it would be on a physical device

pipeline.grainEnabled = true;
pipeline.grain.intensity = 5.3;



highLight = new BABYLON.HighlightLayer("highLight", scene);

var babGreen = new BABYLON.Color3.Green();

var result;
var hlCounter=0;
var onPointerMove = function(e) {
    result = scene.pick(scene.pointerX, scene.pointerY);
    if (result.hit) {
        if(hlCounter>0) {
            for (var xkl = 0; xkl < scene.meshes.length; xkl++) {
                removeColorPulser(scene.getMeshByID(scene.meshes[xkl].id));
                highLight.removeMesh(scene.meshes[xkl]);

            }
        }
        hlCounter= hlCounter+1;
        if(result.pickedMesh.id != prevHighLight) {
            if(result.pickedMesh.name!='Токопроводящая жила') {
                highLight.addMesh(scene.getMeshByID(result.pickedMesh.id), babGreen);
            }else {
                colorPulser(scene.getMeshByID(result.pickedMesh.id));
            }
            prevHighLight =scene.getMeshByID(result.pickedMesh.id);
            //  colorPulser(scene.getMeshByID(result.pickedMesh.id));
            document.getElementById('info').textContent = result.pickedMesh.name;
            document.getElementById('info').style.display = 'block';
        }else {
            scene.getMeshByID(result.pickedMesh.id)
        }

    }else {
        if(hlCounter>0) {
            for (var xkl = 0; xkl < scene.meshes.length; xkl++) {
                removeColorPulser(scene.getMeshByID(scene.meshes[xkl].id));
                highLight.removeMesh(scene.meshes[xkl]);

            }
            hlCounter=0;
        }

        document.getElementById('info').style.display='none';

    }
}

canvas.addEventListener("pointermove", onPointerMove, false);
var alpha = .2;
var colorPulser = function(mesh) {
;
if(typeof mesh === 'undefined' || mesh=='' || !mesh){ return false;}
    if(mesh.hasOwnProperty('object'))
    {
        mesh.object.material.emissiveColor = new BABYLON.Color3.Green();
    }else {
        mesh.material.emissiveColor = new BABYLON.Color3.Green();
    }
};

var removeColorPulser = function(mesh)
{
    if(typeof mesh === 'undefined' || mesh=='' || !mesh){ return false;}
    mesh.material.emissiveColor =new BABYLON.Color3(0,0,0);
}

var targetMesh=scene.getMeshByID('Упрочняющий сердечник');
scene.activeCamera.setTarget(scene.meshes[1].getBoundingInfo().boundingBox.centerWorld );

if(getTotalElems==7){camera.lowerRadiusLimit = 30;}
if(getTotalElems==7 && innerElemsRadius==2.5){camera.lowerRadiusLimit = 34;}
if(getTotalElems==9){camera.lowerRadiusLimit = 30;}
if(getTotalElems==9 && innerElemsRadius==2.5){camera.lowerRadiusLimit = 34;}
if(getTotalElems==12){camera.lowerRadiusLimit = 30;}
if(getTotalElems==12 && innerElemsRadius==2.5){camera.lowerRadiusLimit = 34;}
if(getTotalElems==19 && innerElemsRadius==1.5){camera.lowerRadiusLimit = 30;}
if(getTotalElems==19 && innerElemsRadius==2.5){camera.lowerRadiusLimit = 34;}

var cameraLowestRadius = camera.lowerRadiusLimit;
cameraLowestRadius  = parseUri('cameraLowestRadius');
camera.lowerRadiusLimit = cameraLowestRadius;

scene.freezeActiveMeshes();

/*
var options = new BABYLON.SceneOptimizerOptions(30,900);
options.addOptimization(new BABYLON.HardwareScalingOptimization(0,1));
//options.addOptimization(new BABYLON.HardwareScalingOptimization(10,2));
options.addOptimization(new BABYLON.TextureOptimization(20));
options.addOptimization(new BABYLON.ShadowsOptimization(30));
//options.addOptimization(new BABYLON.MergeMeshesOptimization(40));
options.addCustomOptimization(function () {
    camera.checkCollisions = false;
    scene.collisionsEnabled = false;

    blackPBRTextured.bumpTexture = null;
    blackPBRTextured.enableSpecularAntiAliasing = false;
    blackPBRTextured.sheen.isEnabled = false;


    copperPBRTextured.bumpTexture = null;
    copperPBRTextured.enableSpecularAntiAliasing = false;
    copperPBRTextured.sheen.isEnabled = false;

    blackLightPBRTextured.bumpTexture = null;
    blackLightPBRTextured.enableSpecularAntiAliasing = false;
    blackLightPBRTextured.sheen.isEnabled = false;

    blackPBRTexturedShiny.bumpTexture = null;
    blackPBRTexturedShiny.enableSpecularAntiAliasing = false;
    blackPBRTexturedShiny.sheen.isEnabled = false;

    plasticPBRLightBlue.bumpTexture = null;
    plasticPBRLightBlue.enableSpecularAntiAliasing = false;
    plasticPBRLightBlue.sheen.isEnabled = false;

    plasticPBRGrey.bumpTexture = null;
    plasticPBRGrey.enableSpecularAntiAliasing = false;
    plasticPBRGrey.sheen.isEnabled = false;

    plasticPBRPink.bumpTexture = null;
    plasticPBRPink.enableSpecularAntiAliasing = false;
    plasticPBRPink.sheen.isEnabled = false;

    return true;
}, function () {
    return "Turning bump off";
});

// Optimizer
var optimizer = new BABYLON.SceneOptimizer(scene, options);
setTimeout(function () {
    optimizer.start();
},3000);
/*
BABYLON.SceneOptimizer.OptimizeAsync(scene, BABYLON.SceneOptimizerOptions.HighDegradationAllowed(),
    function() {
        // On success
      //  alert('Всё ок')
    }, function() {
       alert('Ваша графическая карта не обеспечивает должный FPS. Пожалуйста, выйдите!');
    });*/