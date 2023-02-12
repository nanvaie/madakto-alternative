export default function (to, from, next) {
    const token = localStorage.getItem('token');
    if (token !== 'null') {
        next();
    } else {
        next({
            name: 'login', // back to safety route //
        });
    }
}
