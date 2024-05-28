
function openSideBar() {
    $('.right-panel')
        .removeClass('closed')
        .addClass('open')
}

function closeSideBar() {
    $('.right-panel')
        .removeClass('open')
        .addClass('closed')
}

export {
    openSideBar,
    closeSideBar
}
