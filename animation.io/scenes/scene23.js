var scene23 = function(){
  var scene = new Scene('scene23', 'face changes from one face to another');

  var home = scene.createActor('home.png', 10, 10);
  home.navigatesOnTouch('scene0');


  var face1 = scene.createActor('bilder/faces/blick_runter.png', 210, 110);
  face1.addPhase('bilder/faces/denken.png');
  face1.addPhase('bilder/faces/freu.png');
  face1.addPhase('bilder/faces/grantig.png');
  face1.addPhase('bilder/faces/guck_doof.png');
  face1.addPhase('bilder/faces/neutral.png');
  face1.addPhase('bilder/faces/neutral_dumm.png');
  face1.addPhase('bilder/faces/schreck.png');
  face1.addPhase('bilder/faces/triumpg.png');
  face1.phaseCycle =1000;


  scene.write(20, 510, "actor3 lets actor4 move to new position.");

  return scene;
};