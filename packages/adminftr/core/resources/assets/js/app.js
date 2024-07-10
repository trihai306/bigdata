import Cookies from 'js-cookie';

let navbarSearch = document.querySelector('.navbar-search');

if (navbarSearch) {
    let input = navbarSearch.querySelector('input');
    let result = navbarSearch.querySelector('.form-results');
    let resultForceDisplay = false;

    function showResult() {
        result.classList.add('d-block');
        result.classList.remove('d-none');
    }

    function hideResult() {
        if (!resultForceDisplay) {
            result.classList.remove('d-block');
            result.classList.add('d-none');
        }
    }

    input.addEventListener('focus', showResult);

    result.addEventListener('mouseover', () => {
        resultForceDisplay = true;
        showResult();
    });

    result.addEventListener('click', () => {
        resultForceDisplay = true;
        showResult();
    });

    document.addEventListener('click', (e) => {
        const isClickInside = input.contains(e.target) || result.contains(e.target);
        if (!isClickInside) {
            resultForceDisplay = false;
            hideResult();
        }
    });
}

if (!Cookies.get("sidebarState")) {
    Cookies.set("sidebarState", "expanded", {
        expires: 7,
        sameSite: 'Lax'
    });
}

const collapseMenuBtn = document.getElementById('btn-collapse-menu');
const sidebarWrapper = document.getElementById('sidebar-wrapper');
const pageWrapper = document.getElementById('page-wrapper');

if (collapseMenuBtn) {
    collapseMenuBtn.addEventListener('click', function () {
        sidebarWrapper.classList.toggle('state-collapsed');
        pageWrapper.classList.toggle('state-collapsed');
        this.classList.toggle('state-collapsed');

        if (sidebarWrapper.classList.contains('state-collapsed')) {
            Cookies.set("sidebarState", "collapsed", {
                expires: 7,
                sameSite: 'Lax'
            });
        } else {
            console.log(Cookies.set("sidebarState", "expanded", {
                expires: 7,
                sameSite: 'Lax'
            }))
        }
    });
}
