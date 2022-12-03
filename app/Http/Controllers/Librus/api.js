try {
    const synergia = require('librus-api');
    const api = new synergia();
    api.authorize('test', 'test').then(() => {
        api.info.getGrades().then((grades) => {
            //get "name" of object
            console.log(grades);
        });
    });
} catch (e) {
    console.log(e);
}