const synergia = require("librus-api");

class Api {
    getGrades() {
        try {
            const synergia = require('librus-api/lib/api');
            const api = new synergia();
            api.authorize('gg', 'gg').then(() => {
                api.info.getGrades().then((grades) => {
                    //get "name" of object
                    console.log(grades);
                });
            });
        } catch (e) {
            console.log(e);
        }
    }
}

module.exports = Api
