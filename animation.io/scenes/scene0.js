/* globals Scene */
/* exported scene0 */

var scene0 = function(){
  var scene = new Scene('scene0', 'All');

  scene.write(20, 20, "Animation Framework</span>", "title");
  scene.write(20, 50, "initiated by <a href='http://mehreinfach.de'>Mehreinfach</a>, download free at <a href='http://animation.io'>animation.io</a>", "small");

  scene.write(20, 100, "Animation examples:", "grey small");

  // APPEARS
  var appears = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 20, 130, 240, 70);
  appears.setText("appears/dissolves","","button");
  appears.navigatesOnTouch('scene4');

  // MOVESTO
  var moves = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 20, 210, 240, 70);
  moves.setText("moves","","button");
  moves.navigatesOnTouch('scene1');

  // SHAKING
  var shakes = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 20, 290, 240, 70);
  shakes.setText("shakes","","button");
  shakes.navigatesOnTouch('scene2');

  // PULSATES
  var pulsates = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 20, 370);
  pulsates.setText("pulsates","","button");
  pulsates.navigatesOnTouch('scene6');

  // ROTATES
  var rotates = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 20, 450);
  rotates.setText("rotates","","button");
  rotates.navigatesOnTouch('scene3');

  // ADD PHASE
  var addphase = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 270, 130);
  addphase.setText("phases","","button");
  addphase.navigatesOnTouch('scene11');

  // WAVES
  var waves = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 270, 290);
  waves.setText("waves","","button");
  waves.navigatesOnTouch('scene5');

  // DRIFTS
  var drifts = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 270, 370);
  drifts.setText("drifts","","button");
  drifts.navigatesOnTouch('scene7');

  // SWINGS
  var swings = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 270, 450);
  swings.setText("swings","","button");
  swings.navigatesOnTouch('scene13');

  // PLAYS
  var plays = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 520, 130);
  plays.setText("plays", "", "button");
  plays.navigatesOnTouch('scene15');

  // CLONES
  var clones = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 270, 210);
  clones.setText("clones", "", "button");
  clones.navigatesOnTouch('scene16');

  // TEXT & COUNT
  var textcount = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 520, 210);
  textcount.setText("text, count (dev)", "", "button");
  textcount.navigatesOnTouch('scene17');

  // CIRCLES
  var circles = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 520, 290);
  circles.setText("circles (dev)", "", "button");
  circles.navigatesOnTouch('scene18');

  // LINKS
  var links = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 520, 370);
  links.setText("links", "", "button");
  links.navigatesOnTouch('scene19');

  // POPUP
  var popup = scene.createActor('http://www.dollyonrails.de/wp-content/uploads/2013/03/dollyonrails01-300x180.jpg', 520, 450);
  popup.setText("popup", "", "button");
  popup.navigatesOnTouch('scene20');

  return scene;
};
