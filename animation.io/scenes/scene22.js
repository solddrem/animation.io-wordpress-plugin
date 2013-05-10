var scene22 = function(){
  var scene = new Scene('scene22', 'Moving');

  var home = scene.createActor('home.png', 10, 10);
  home.navigatesOnTouch('scene0');

  var erde = scene.createActor('bilder/ErdeSonne/erde.png', 210, 110);
  erde.moves(0.05,0.00);
  var sonne = scene.createActor('bilder/ErdeSonne/sonne.png', 210, 110);
    sonne.moves(0.05,0.07);

  var erde1 = scene.createActor('bilder/ErdeSonne/erde.png', 210, 110);
  var sonne1 = scene.createActor('bilder/ErdeSonne/sonne.png', 210, 110);
    sonne1.moves(0.05,0.07);

  scene.write(20, 510, "actor3 lets actor4 move to new position.");

  return scene;
};