function ajustarAltura() {
    var video = document.getElementById('my-video');
    var anchoInicial = 616; // Coloca aquí el ancho inicial del video
    var altoInicial = 346; // Coloca aquí el alto inicial del video

    var nuevoAncho = video.offsetWidth;
    var nuevoAlto = (nuevoAncho * altoInicial) / anchoInicial;

    video.style.height = nuevoAlto + 'px';
}

// Llama a la función al cargar la página y cada vez que la ventana cambia de tamaño
window.onload = window.onresize = ajustarAltura;
