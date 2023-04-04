var bodyMain = BABYLON.MeshBuilder.CreateCylinder("bodyMain", {
    height : bodyLen,
    diameterTop : bodyDiamTop,
    diameterBottom : bodyDiamBot,
    tessellation : 32
}, scene);


bodyMain.lookAt(new BABYLON.Vector3(0, 90, 0));
bodyMain.material = eval(bodyMaterial);

if (getParameterByName('upd') == 1) {
    var filling = BABYLON.MeshBuilder.CreateCylinder("bodyMain", {
        height : fillLen,
        diameterTop : fillDiamTop,
        diameterBottom : fillDiamBot,
        tessellation : 32
    }, scene);
    filling.lookAt(new BABYLON.Vector3(0, 90, 0));
    filling.material = eval(fillMaterial);
    filling.position.x = filling.position.x + 1;
    filling.position.y = filling.position.y;
    

    for ( i = 1; i <= parseInt(cutCount); i++) {
        if ( typeof cutFillMatArr[i] === 'undefined' || cutFillMatArr[i] === null) {
            cutFillMatArr[i] = getParameterByName('cfm' + i);
        }
        if ( typeof cutFillMatArr[i] === 'object' || cutFillMatArr[i] === null) {
            cutFillMatArr[i] = 'nullLinePBR';
        }
        
       if ( typeof cutFillLenArr[i] === 'undefined' || cutFillLenArr[i] === null) {
            cutFillLenArr[i] = getParameterByName('cutfilllen'+i);
        }
         if ( typeof cutFillLenArr[i] !== 'string' || cutFillLenArr[i] === null) {
            cutFillLenArr[i] = 0.3;
        }
        
        
         if ( typeof cutLenArr[i] === 'undefined' || cutLenArr[i] === null) {
            cutLenArr[i] = getParameterByName('cutlen'+i);
        }
         if ( typeof cutLenArr[i] !== 'string' || cutLenArr[i] === null) {
            cutLenArr[i] = 0.3;
        }
        
        
        if (cutCount == 1) {
            globMeshes[i] = BABYLON.MeshBuilder.CreateCylinder("fillCut", {
                height : cutFillLenArr[i],
                diameterTop : cutFillRad,
                diameterBottom : cutFillRad,
                tessellation : 32
            }, scene);
            globCuts[i] = BABYLON.MeshBuilder.CreateCylinder("cut", {
                height : cutLenArr[i],
                diameterTop : cutDiam,
                diameterBottom : cutDiam,
                tessellation : 32
            }, scene);

        } else {
            globMeshes[i] = BABYLON.MeshBuilder.CreateCylinder("fillCut", 2Q
                height : cutFillLenArr[i],
                diameterTop : cutFillRad,
                diameterBottom :cutFillRad,
                tessellation : 32
            }, scene);
            globCuts[i] = BABYLON.MeshBuilder.CreateCylinder("cut"+i, {
                height : cutLenArr[i],
                diameterTop : cutDiam ,
                diameterBottom : cutDiam,
                tessellation : 32
            }, scene);
            if(cutCount<6){
              var realFillDiam=cutFillRad / parseFloat(2+'.'+cutCount);
              var realFillRad=realFillDiam/2;
              let curAngle;
              if(cutCount!=3){
               curAngle = angles[i-1];    
              }
              else
              {
                  let miniAngles=[0,115,180];
                  curAngle = miniAngles[i-1];    
              }
              let curRad=(fillDiamTop/2)-cutDiam;
              let cutFillPosY=(curRad) * Math.cos(curAngle);
              let cutFillPosZ=(curRad) * Math.sin(curAngle);
              
               intersectPoints[i]=[cutFillPosY,cutFillPosZ,realFillDiam];       
              
     //      y_oncircle = (realFillRad) *  Math.cos((i-1)*45);
     //      z_oncircle = (realFillRad) * Math.sin((i-1)*45);        
            globMeshes[i].position.y = cutFillPosY;
            globMeshes[i].position.z = cutFillPosZ;
            globCuts[i].position.y = globMeshes[i].position.y;
            globCuts[i].position.z = globMeshes[i].position.z;
            }else
            {
            }     
}

console.log('bodyLen:'+bodyLen);
console.log('filllen:'+fillLen);
console.log('cutFillLen:'+cutFillLenArr[i]);
        filling.position.x = bodyLen/2; 
        
        globCuts[i].lookAt(new BABYLON.Vector3(0.59, 90, 0));
        globMeshes[i].rotate(new BABYLON.Vector3(0, 0, 1), 1.57, BABYLON.Space.WORLD);
        globMeshes[i].position.x =(bodyLen/2)-0.005+(fillLen/2)-0.005;
       globCuts[i].position.x =globMeshes[i].position.x+cutFillLenArr[i]/2;
        
       
        if (i == 1 & cutCount == 1) {
            var direction = new BABYLON.Vector3(0, 0, 0);
            direction.normalize();
           // globCuts[i].translate(direction, 0.112, BABYLON.Space.WORLD);
            //globMeshes[i].translate(direction, 0.112, BABYLON.Space.WORLD);
        } else {

       

      if(i==5)
      {
            var direction = new BABYLON.Vector3(0, 1, 0);
            direction.normalize();
            globCuts[5].translate(direction, 0.04, BABYLON.Space.WORLD);
            globMeshes[5].translate(direction, 0.04, BABYLON.Space.WORLD);
      }
      
}
        if (globMeshes[i] !== null & cutFillMatArr[i] === null) {
            cutFillMatArr[i] = 'nullLinePBR';
        }

        globMeshes[i].material = eval(cutFillMatArr[i]);
        // evil thing...
        if (cutType == 'alum') {
            globCuts[i].material = alumPBR;
        } else {
            globCuts[i].material = copperPBR;
        }
        console.log('i:'+i);
  
      /*  
let torus = BABYLON.MeshBuilder.CreateTorus("torus", {thickness: 0.009,tesselation:128,diameter:cutDiam / 1.8}, scene);
torus.position.x=globCuts[i].position.x+cutLenArr[i]/2;
torus.position.y=globCuts[i].position.y;
torus.position.z=globCuts[i].position.z;
torus.rotate(new BABYLON.Vector3(0, 0, 1), 1.58, BABYLON.Space.WORLD);
*/
/*
let cutDiag = BABYLON.MeshBuilder.CreateDisc("disc", {tessellation: 64}, scene);
cutDiag.position.x=globCuts[i].position.x+cutLenArr[i]/3;
cutDiag.position.y=globCuts[i].33position.y;
cutDiag.position.z=globCuts[i].position.z;
cutDiagAngle=2.73;
cutDiag.rotate(new BABYLON.Vector3(1, 1, 1),cutDiagAngle, BABYLON.Space.WORLD);

let p = BABYLON.CSG.FromMesh(globCuts[i]);
let v = BABYLON.CSG.FromMesh(cutDiag);
let d = p.subtract(v);
let baguette = d.toMesh("csghole", null, scene);
baguette.material=globCuts[i].material;
globCuts[i].dispose();
cutDiag.dispose();
*/


  }
  
  var realRad=cutFillRad;
  realRad=realRad/2;
  var undone=0;
  //while(undone<){
      

    //sqrt((x1-x2)^2+(y1-y2)^2) <=r1+r2
    //

    var getInnerIntersection = function(x1,x2,y1,y2,r1,r2)
    {
        let powSum = Math.pow((x1-x2),2) + Math.pow((y1-y2),2);
        let radSum = r1 + r2;
        if(powSum < radSum)
        {
            return true;
        }else
        {
            return false;
        }
    }

    var rotateIntersection = function() {
     //  console.log(intersectPoints);
        intersectPoints.shift();
              isNaNCounter=0; 
        for (let i = 1; i < intersectPoints.length; i++) {
            console.log('counter: ' + isNaNCounter);
            for (let j = 1; j < intersectPoints.length; j++) {
                console.log('next step'+intersectPoints[j][0]-intersectPoints[i][0]);
                var e=intersectPoints[j][0]-intersectPoints[i][0];
                var f=intersectPoints[j][1]-intersectPoints[i][1];
                var p = Math.sqrt(Math.pow(e, 2) + Math.pow(f, 2));
                var k = (Math.pow(p, 2) + Math.pow(realRad, 2) - Math.pow(realRad, 2)) / (2 * realRad);
                var x1 = intersectPoints[i][0] + ((e * k) / p) + ((f / p) * Math.sqrt(Math.pow(realRad, 2) - Math.pow(k, 2)));
                var y1 = intersectPoints[i][1] + ((f * k) / p) - ((e / p) * Math.sqrt(Math.pow(realRad, 2) - Math.pow(k, 2)));
                var x2 = intersectPoints[i][0] + ((e * k) / p) - ((f / p) * Math.sqrt(Math.pow(realRad, 2) - Math.pow(k, 2)));
                var y2 = intersectPoints[i][1] + ((f * k) / p) + ((e / p) * Math.sqrt(Math.pow(realRad, 2) - Math.pow(k, 2)));

                if (!isNaN(x1)) {
                    isNaNCounter++;
                     fillDiamTop = fillDiamTop + 0.008;
                         let newRad = fillDiamTop / 4; 
                         console.log('nr'+newRad);
                         filling.dispose();
                         filling = BABYLON.MeshBuilder.CreateCylinder("bodyMain", {
                            height : fillLen,
                            diameterTop : fillDiamTop,
                            diameterBottom : fillDiamTop,
                            tessellation : 32
                        }, scene);
                        filling.lookAt(new BABYLON.Vector3(0, 90, 0));
                        filling.material = eval(fillMaterial);
                        filling.position.x = filling.position.x + 1;
                        filling.position.y = filling.position.y;
                        var curAngle;
                    for ( z = 1; z <= parseInt(cutCount); z++) {
                         
                              if(cutCount!=3){
                               curAngle = z*30;    
                              }
                              else
                              {
                               //   curAngle = i*10; 
                                  let miniAngles=[0,115,180];
                                  curAngle = miniAngles[z-1];    
                              }
                              console.log('can:'+curAngle);
                         let cutFillPosY = newRad * Math.cos(curAngle); 
                         let cutFillPosZ = newRad * Math.sin(curAngle);                    
                         intersectPoints[z]=[cutFillPosY,cutFillPosZ,realFillDiam];       
                         globMeshes[z].position.y = cutFillPosY;
                         globMeshes[z].position.z = cutFillPosZ;
                         globCuts[z].position.y = globMeshes[z].position.y;
                         globCuts[z].position.z = globMeshes[z].position.z;
                    }
                }
            }

        }
        if (isNaNCounter == 0) {
            return false;
        } else {
            return true;
        }

    }


      
  var isInter=function(invert=0){   
      isNaNCounter=0; 
  for(i=1;i<intersectPoints.length;i++)
  {
      
      console.log('counter: '+isNaNCounter);
      for(j=1;j<intersectPoints.length;j++)
      {
     //  if(i!=j){   
       let e=intersectPoints[j][0]-intersectPoints[i][0];
       let f=intersectPoints[j][1]-intersectPoints[i][1];
       let p=Math.sqrt(Math.pow(e,2)+Math.pow(f,2));
      
       let k=(Math.pow(p,2)+Math.pow(realRad,2) - Math.pow(realRad,2))/(2*realRad);
       
       let x1=intersectPoints[i][0] + ((e*k)/p) + ((f/p)*Math.sqrt(Math.pow(realRad,2) - Math.pow(k,2)));
       let y1=intersectPoints[i][1] + ((f*k)/p) - ((e/p)*Math.sqrt(Math.pow(realRad,2) - Math.pow(k,2)));

      let x2=intersectPoints[i][0] + ((e*k)/p) - ((f/p)*Math.sqrt(Math.pow(realRad,2) - Math.pow(k,2)));
       let y2=intersectPoints[i][1] + ((f*k)/p) + ((e/p)*Math.sqrt(Math.pow(realRad,2) - Math.pow(k,2)));
       
   //    console.log('e:'+e+' f:'+f+' p:'+p+' k:'+k);
     //  console.log('i:'+i+' j:'+j+' x1:'+x1+' y1:'+y1+' x2:'+x2+' y2:'+y2);
       if(!isNaN(x1))
       { isNaNCounter++;
           globMeshes[i].position.y=globMeshes[i].position.y-k;
            globMeshes[i].position.z=globMeshes[i].position.z-k;
            
           globMeshes[j].position.y=globMeshes[j].position.y+k;
           globMeshes[j].position.z=globMeshes[j].position.z+k;
        
           globCuts[i].position.y=globCuts[i].position.y-k;
           globCuts[j].position.y=globCuts[j].position.y+k;
           globCuts[i].position.z=globCuts[i].position.z-k;
           globCuts[j].position.z=globCuts[j].position.z+k;
           console.log('i was:'+intersectPoints[i]);
         intersectPoints[i]=[globMeshes[i].position.y,globMeshes[i].position.z];
          console.log('i now:'+intersectPoints[i]);
          console.log('j was:'+intersectPoints[j]);
          intersectPoints[j]=[globMeshes[j].position.y , globMeshes[j].position.z];
          console.log('j now:'+intersectPoints[j]);
          
//          intersectPoints[j]=[globMeshes[j].position.y,globMeshes[j].position.z];
         //  globMeshes[j].dispose();
       }
      // }
      }
      
  }
      if(isNaNCounter==0)
      {
          return false;
      }else
      {
          return true;
      }
  }


 var incrInnerDiam = function()
 {
  let totalCutLen=(2*Math.PI*realRad)*cutCount;
  let fillDiamLen=2*Math.PI*fillDiamTop;
  let v=totalCutLen-fillDiamLen;
  if(Math.abs(v)>0.2)
  {
      fillDiamMod=fillDiamTop+Math.abs(v/cutCount);
      fillDiamMod=fillDiamMod+0.01;
    filling.dispose();
       filling = BABYLON.MeshBuilder.CreateCylinder("bodyMain", {
        height : fillLen,
        diameterTop : fillDiamMod,
        diameterBottom : fillDiamMod,
        tessellation : 32
    }, scene);
    filling.lookAt(new BABYLON.Vector3(0, 90, 0));
    filling.material = eval(fillMaterial);
    filling.position.x = filling.position.x + 1;
    filling.position.y = filling.position.y;
      bodyDiam=parseFloat(fillDiamMod+0.028);
      
      bodyMain.dispose();
      bodyMain = BABYLON.MeshBuilder.CreateCylinder("bodyMain", {
    height : bodyLen,
    diameterTop : bodyDiam,
    diameterBottom : bodyDiam,
    tessellation : 32
}, scene);

bodyMain.lookAt(new BABYLON.Vector3(0, 90, 0));
bodyMain.material = eval(bodyMaterial);
      console.log(v+' '+fillDiamMod+' '+fillDiamTop +' '+totalCutLen+' '+fillDiamLen);
           
     }
 }
 
 createLabel(bodyMain,'Внешняя оболочка','70%','0%','0%');
createLabel(filling,'Заполнение','60%','10%','10');

 for(setLabels=1;setLabels<globCuts.length;setLabels++)
 {
     createLabel(globCuts[setLabels],'Токопроводящая жила','20%','0','10');
     createLabel(globMeshes[setLabels],'Оболочка жилы','10%','10%','10');

 }
 createLabelNoMesh('Жил: '+cutCount+'\n Сечение: '+getRealCut(cutDiam),'0%','0%');
 
}