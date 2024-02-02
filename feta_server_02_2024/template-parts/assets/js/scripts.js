// Funktion zur Prüfung ob JS geladen wurde (ändern der Klasse "no-js" im HTML-Tag)
function jsLoaded() {
    const htmlTag = document.querySelector('html')
    htmlTag.classList.remove('no-js')
    htmlTag.classList.add('js')
}

// Show/Hide To-Top Button
function showToTop() {
    const toTopButton = document.getElementById('to-top')
    if (window.scrollY > 200) {
        toTopButton.classList.add('show')
    } else {
        toTopButton.classList.remove('show')
    }
}


// scroll to top bei Button Klick
document.getElementById('to-top').addEventListener('click', function () {
    document.body.scrollTop = 0
    document.documentElement.scrollTop = 0
})


// Funkton um Elementen die Klasse "animate" zuzuweisen
function elementAddAnimate() {
    let elements = document.querySelectorAll('h2, h3, .product, p, .animation')
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.add('animate')
    }
}


// Funktion zur Überprüfung ob Elemente im Viewport sind
function elementInViewport() {

    // Finde alle Elemente mit der Klasse "anmimate"
    let elements = document.querySelectorAll('.animate')
    // Lege einen Klassen-Namen fest, der bei "inViewport" hinzugefügt wird
    let elementClass = 'animated'

    // Abfragen der Fenster-Höhe
    let windowHeight = window.innerHeight || document.documentElement.clientHeight
    // Abfrage der Fenster Top-Position
    let windowTopPosition = window.scrollY
    // Berechnen der Window Bottom-Position
    let windowBottomPosition = (windowHeight + windowTopPosition)

    // Schleife wird so oft durchlaufen, dass alle Elemente aus der "nodeList" geprüft werden können
    for (let i = 0; i < elements.length; i++) {
        // Element Top Position berechnen
        let elementTopPosition = elements[i].getBoundingClientRect().top + windowTopPosition
        // Element Bottom Position berechnen
        let elementBottomPosition = elements[i].getBoundingClientRect().bottom + windowTopPosition

        // Bedingung zur Prüfung, ob das Element im Viewport ist
        if ((windowBottomPosition > elementTopPosition) && (windowTopPosition < elementBottomPosition)) {
            elements[i].classList.add(elementClass)
        } else {
            //elements[i].classList.remove(elementClass)
        }
    }

}



// Event Listner "DOMContentLoaded" wird nur ausgeführt wenn der DOM fertig aufgebaut ist
document.addEventListener('DOMContentLoaded', function () {
    
    jsLoaded()
    elementAddAnimate()
    elementInViewport()

}, false)


// Event Listner "scroll" wird nur ausgeführt wenn gescrollt wird
document.addEventListener('scroll', function () {

    showToTop()
    elementInViewport()

})


// Event Listner "resize" wird nur bei Veränderung der Fenstergröße ausgeführt
window.addEventListener('resize', function () {

    elementInViewport()

})