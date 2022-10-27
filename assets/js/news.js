function initTab(elem){

    //addEventListener on mouse click
    document.addEventListener('click', function (e) {

        //check is the right element clicked
        if (!e.target.matches(elem+' [data-tab-button]')) return;
        else{
            if(!e.target.classList.contains('active')){

                //if option true remove active class from all other elements
                findActiveElementAndRemoveIt(elem+' [data-tab-button]');
                findActiveElementAndRemoveIt(elem+' [data-tab-content]');

                //add active class on clicked tab
                e.target.classList.add('active');

                //console.log(e.target.dataset.slug);
                var panel = document.querySelectorAll('[data-content="'+ e.target.dataset.slug +'"]');
                Array.prototype.forEach.call(panel, function (el) {
                    //add active class on right t-panel after 200ms because of the smooth animation
                    el.classList.add('active');
                });
            }
        }
    });
}

//if option true remove active class from added element
function findActiveElementAndRemoveIt(elem){
    var elementList = document.querySelectorAll(elem);
    Array.prototype.forEach.call(elementList, function (e) {
        e.classList.remove('active');
    });
}

//activate tabs function
initTab('.tabs__content-wrap');