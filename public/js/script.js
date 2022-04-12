// Created By Thomas Thackeray C3554686
// When the content is loaded to the screen start running this
document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleButtonId, NavigationBarID, MainContentID, TopHeaderID) =>{
        const expandMenuButton = document.getElementById(toggleButtonId),
        navigationBar = document.getElementById(NavigationBarID),
        bodyPadding = document.getElementById(MainContentID),
        headerPadding = document.getElementById(TopHeaderID)

        // Check to make sure that all the variable exist when the screen is loaded by adding them again
        if(expandMenuButton && navigationBar && bodyPadding && headerPadding){
            // If The Expand Menu Button Is Pressed Expand It And Move The Complete Body To The Right
            expandMenuButton.addEventListener('click', ()=>{
                navigationBar.classList.toggle('expand_menu')
                bodyPadding.classList.toggle('body-padding')
                headerPadding.classList.toggle('body-padding')
            })
        }
    }

    showNavbar('header-toggle','nav-bar','body-padding','header')

});

   