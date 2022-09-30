try {
    const synergia = require('librus-api/lib/api');
    const api = new synergia();
    api.authorize('10281889u', 'Qo-71ghabd5').then(() => {
        api.info.getGrades().then((grades) => {
            //get "name" of object
            console.log(grades);
            document.cookie = JSON.stringify(grades);
        });
    });
} catch (e) {
    console.log(e);
}
