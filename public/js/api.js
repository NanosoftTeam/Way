import Librus from 'librus-api';

function login() {
    try {
        let librus = new Librus();
        librus.authorize('10281889u', 'Qo-71ghabd5').then(() => {
            console.log("Logged in");
            librus.info.getGrades().then((grades) => {
                console.log(grades);
            });
        });
    } catch (e) {
        console.log(e);
    }

}
