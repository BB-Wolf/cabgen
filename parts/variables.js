var cutCount = '';
var cutDiam = '';
var cutMat = '';
var cutType = '';
var cutLenArr = new Array();

var cutFillRad = '';
var cutFillMat = '';
var cutFillMatArr = new Array();
var cutFillLenArr = new Array();

var bodyLen = '';
var bodyDiam = '';
var bodyDiamTop = '';
var bodyDiamBot = '';
var bodyMaterial = '';

var fillDiam = '';
var fillDiamTop = '';
var fillDiamBot = '';
var fillMaterial = '';
var fillLen = '';

var preset = getParameterByName('preset'); 

var intersectPoints= new Array();

//var angles = [45,180,90,225,135,270,270];
var angles = [45,180,90,225,135,270,270];

var positionsArray_x = new Array();
var positionsArray_y =new Array();
var positionsArray_z = new Array();

var globMeshes = new Array();
var globCuts = new Array();


 var createLabel = function(mesh,labelText,topPos="20%",leftPos="20%",linkOffset="56") {
    var label = new BABYLON.GUI.Rectangle("label for ");
    label.background = "black"
    label.height = "40px";
    label.alpha = 0.5;
    label.width = "220px";
    label.cornerRadius = 0;
    label.thickness = 1;
    label.linkOffsetY = 30;
    label.top = topPos;
    label.left = leftPos;
    label.zIndex = 5;
    label.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;    
    advancedTexture.addControl(label); 

        var text1 = new BABYLON.GUI.TextBlock();
        text1.text = labelText;
        text1.color = "white";
        label.addControl(text1);  
        
        var line = new BABYLON.GUI.Line();
        line.alpha = 0.8;
        line.lineWidth = 2;
        line.dash = [5, 10];
        advancedTexture.addControl(line); 
        line.linkWithMesh(mesh);
        line.linkOffsetX=linkOffset;
        line.connectedControl = label;
    }  
   
   
 var createLabelNoMesh = function(labelText,topPos="20%",leftPos="20%",linkOffset="56") {
    var label = new BABYLON.GUI.Rectangle("label for ");
    label.background = "black"
    label.height = "40px";
    label.alpha = 0.5;
    label.width = "220px";
    label.cornerRadius = 0;
    label.thickness = 1;
    label.linkOffsetY = 30;
    label.top = topPos;
    label.left = leftPos;
    label.zIndex = 5;
    label.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;    
    advancedTexture.addControl(label); 

        var text1 = new BABYLON.GUI.TextBlock();
        text1.text = labelText;
        text1.color = "white";
        label.addControl(text1);  
        
    }   
    
    
    
var advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI("UI");

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
var bend = [
            new BABYLON.Vector3(-1.0, 1, 0.2),
            new BABYLON.Vector3(-1.5, 1.1, 0.2),
            new BABYLON.Vector3(-1.9, 1.65, 0.2),
            new BABYLON.Vector3(-1.9, 1.7, 0.2),
    ];*/
   
      /*     var myShape = [
            new BABYLON.Vector3(0, 5, 0),
            new BABYLON.Vector3(1, 1, 0),
            new BABYLON.Vector3(5, 0, 0),
            new BABYLON.Vector3(1, -1, 0),
            new BABYLON.Vector3(0, -5, 0),
            new BABYLON.Vector3(-1, -1, 0),
            new BABYLON.Vector3(-5, 0, 0),
            new BABYLON.Vector3(-1, 1, 0)
    ];
    
    myShape.push(myShape[0]);
    
    var myPath = [
            new BABYLON.Vector3(0, 0, 0),
            new BABYLON.Vector3(12, 2, 0),
            new BABYLON.Vector3(14, 4, 0),
            new BABYLON.Vector3(16, 6, 0),
            new BABYLON.Vector3(20, 8, 0),
            new BABYLON.Vector3(22, 10, 0)
    ];
    
    var scaling = function(i, distance) {
        return 1/(i+1);
    };*/   
   
    