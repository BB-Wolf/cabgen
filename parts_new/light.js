var lightCollection = new Array();

var createLight = function(lightType,lightName,vector = zeroVector,_scene = scene)
{
    var newLight = '';
    if(lightType=='' || typeof lightType === 'undefined' || lightType=='undefined')
    {
        let lightGenericName = "HemiSphericLight"+eval(lightCollection.length+1);
        newLight = new BABYLON.HemisphericLight(lightGenericName,vector,_scene);
    }
    if(lightType == 'hemi'){
        if(lightName =='' || typeof lightName === 'undefined'){
            let lightGenericName = "HemiSphericLight"+eval(lightCollection.length+1);
             newLight = new BABYLON.HemisphericLight(lightGenericName,vector,_scene);
        }else
        {
             newLight = new BABYLON.HemisphericLight(lightName,vector,_scene);
        }
    }
    if(lightType == 'point'){
        if(lightName =='' || typeof lightName === 'undefined'){
            let lightGenericName = "PointLight"+eval(lightCollection.length+1);
             newLight = new BABYLON.PointLight(lightGenericName,vector,_scene);
        }else
        {
             newLight = new BABYLON.PointLight(lightName,vector,_scene);
        }
    }
    if(lightType == 'direct'){
        if(lightName =='' || typeof lightName === 'undefined'){
            let lightGenericName = "DirectLight"+eval(lightCollection.length+1);
             newLight = new BABYLON.DirectionalLight(lightGenericName,vector,_scene);
        }else
        {
             newLight = new BABYLON.DirectionalLight(lightName,vector,_scene);
        }
    }
    lightCollection.push(newLight);
};


var modifyLight = function (obj,param,paramVal)
{
  if(obj=='' || typeof obj === 'undefined' || obj === 'undefined')
  {
      console.log('You must provide right type of object');
      return false;
  }

  if(param=='' || typeof param === 'undefined' || param === 'undefined'){
        console.log('No parameter specified');
      return false;
  }
  if(typeof paramVal === 'undefined' || paramVal === 'undefined'){
        console.log('No value specified');
        console.log(typeof paramVal);
      return false;
  }
  if(param == 'intensity'){ obj.intensity=paramVal;}
  if(param == 'range'){ obj.range=paramVal;}
  if(param == 'radius'){ obj.radius=paramVal;}
  if(param == 'diffuse'){obj.diffuse = paramVal;}
  if(param == 'specular'){obj.specular = paramVal;}
}



createLight('direct','',new BABYLON.Vector3(0, 0, 0.5));
if(location.href.indexOf('Shadows')!=-1){
createLight('direct','',new BABYLON.Vector3(0, 0, -5));
createLight('direct','',new BABYLON.Vector3(0, 0, 5));
}
else{

    createLight('direct','',new BABYLON.Vector3(0, 0, -0.5));
    createLight('direct','',new BABYLON.Vector3(0, 0, 0.5));
}
createLight('direct','',new BABYLON.Vector3(0.5, 0.5, -0.5));

modifyLight(lightCollection[1],'intensity',5);
modifyLight(lightCollection[2],'intensity',5);


/*
var shadowGenerator = new BABYLON.ShadowGenerator(1024, lightCollection[2]);
shadowGenerator.useCloseExponentialShadowMap = true;
*/

if(location.href.indexOf('lightShadows')!=-1)
{
    var shadowGenerator = new BABYLON.ShadowGenerator(1024, lightCollection[0]);
    shadowGenerator.usePercentageCloserFiltering = true;
    var shadowGenerator2 = new BABYLON.ShadowGenerator(1024, lightCollection[1]);
    shadowGenerator2.usePercentageCloserFiltering = true;
    var shadowGenerator3 = new BABYLON.ShadowGenerator(1024, lightCollection[2]);
    shadowGenerator3.usePercentageCloserFiltering = true;
    var shadowGenerator4 = new BABYLON.ShadowGenerator(1024, lightCollection[3]);
    shadowGenerator4.usePercentageCloserFiltering = true;
}

if(location.href.indexOf('fullShadows')!=-1){
var csmShadowGenerator = new BABYLON.CascadedShadowGenerator(1024, lightCollection[2]);
var csmShadowGenerator2 = new BABYLON.CascadedShadowGenerator(1024, lightCollection[1]);
var csmShadowGenerator3 = new BABYLON.CascadedShadowGenerator(1024, lightCollection[3]);
var csmShadowGenerator4 = new BABYLON.CascadedShadowGenerator(1024, lightCollection[0]);
csmShadowGenerator.cascadeBlendPercentage = 0.52;
csmShadowGenerator2.cascadeBlendPercentage = 0.52;
csmShadowGenerator3.cascadeBlendPercentage = 0.52;
csmShadowGenerator4.cascadeBlendPercentage = 0.52;

csmShadowGenerator.stabilizeCascades = true;
csmShadowGenerator.autoCalcDepthBounds = true;
csmShadowGenerator.depthClamp = true;
csmShadowGenerator.lambda = 1;
csmShadowGenerator.darkness = 0.4;
csmShadowGenerator.normalBias = 0.09;



csmShadowGenerator2.stabilizeCascades = true;
csmShadowGenerator2.autoCalcDepthBounds = true;
csmShadowGenerator2.depthClamp = true;
    csmShadowGenerator2.lambda = 1;
    csmShadowGenerator2.darkness = 0.4;
    csmShadowGenerator2.normalBias = 0.09;
    csmShadowGenerator2.numCascades = 8;


    csmShadowGenerator3.stabilizeCascades = true;
csmShadowGenerator3.autoCalcDepthBounds = true;
    csmShadowGenerator3.depthClamp = true;
    csmShadowGenerator3.lambda = 1;
    csmShadowGenerator3.darkness = 0.4;
    csmShadowGenerator3.normalBias = 0.09;

    csmShadowGenerator4.stabilizeCascades = true;
csmShadowGenerator4.autoCalcDepthBounds = true;
    csmShadowGenerator4.depthClamp = true;
    csmShadowGenerator4.lambda = 1;
    csmShadowGenerator4.darkness = 0.4;
    csmShadowGenerator4.normalBias = 0.09;

}

/*
createLight('direct','',new BABYLON.Vector3(0,1,3));
createLight('direct','',new BABYLON.Vector3(0,1.5,-3));
createLight('direct','',new BABYLON.Vector3(0,1,-3));
*/
//createLight('hemi','',new BABYLON.Vector3(10,0,0));
//createLight();
//createLight();
//createLight('direct','',new BABYLON.Vector3(-5,0,0));
/*
modifyLight(lightCollection[0],'intensity',4);
modifyLight(lightCollection[0],'range',12);
modifyLight(lightCollection[1],'intensity',4);
modifyLight(lightCollection[1],'range',12);*/

//modifyLight(lightCollection[3],'intensity',0.5);
