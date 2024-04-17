
document.addEventListener("DOMContentLoaded", function() {
    // Función para mostrar/ocultar el formulario de agregar cámara
    document.getElementById("add-camera-btn").addEventListener("click", function() {
        document.getElementById("add-camera-form").style.display = "block";
    });

    // Función para cerrar el formulario de agregar cámara
    document.getElementsByClassName("close")[0].addEventListener("click", function() {
        document.getElementById("add-camera-form").style.display = "none";
    });

    // Función para mostrar/ocultar el formulario de eliminar cámara
    document.getElementById("delete-camera-btn").addEventListener("click", function() {
        document.getElementById("delete-camera-form").style.display = "block";
    });

    // Función para cerrar el formulario de eliminar cámara
    document.getElementsByClassName("close")[1].addEventListener("click", function() {
        document.getElementById("delete-camera-form").style.display = "none";
    });
    
    //  Función para mostrar la ventana modal de información de la cuenta
     document.getElementById("cuenta-btn").addEventListener("click", function() {
        document.getElementById("cuenta-form").style.display = "block";
     });

    //  Función para cerrar la ventana modal de información de la cuenta
     document.getElementsByClassName("close")[2].addEventListener("click", function() {
     document.getElementById("cuenta-form").style.display = "none";
     });

    // Cerrar ventana modal al cargar la página
    var modal = document.getElementById('myModal');
    if (modal) {
        modal.style.display = 'block';
    }

    // Función para cerrar la ventana modal
    var closeButton = document.querySelectorAll(".close");
    closeButton.forEach(function(btn) {
        btn.addEventListener("click", function() {
            modal.style.display = "none";
        });
    });
});

// Para fuera del index
window.onload = function() {
    // Mostrar el modal al cargar la página
    var modal = document.getElementById('myModal');
    modal.style.display = 'block';
  
    // Función para cerrar la ventana modal
    var closeButton = document.querySelector(".close");
    if (closeButton) {
        closeButton.addEventListener("click", function() {
            modal.style.display = "none";
        });
    }
};

function mostrarVideo(url) {
    var ventanaVideo = document.getElementById('ventanaVideo');
    var video = document.getElementById('video');
    video.src = url;
    ventanaVideo.style.display = 'block';
}

function cerrarVideo() {
    var ventanaVideo = document.getElementById('ventanaVideo');
    var video = document.getElementById('video');
    video.src = '';
    ventanaVideo.style.display = 'none';
}

function toggleFullScreen() {
    var video = document.getElementById('video');
    if (video.requestFullscreen) {
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen();
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen();
    } else if (video.msRequestFullscreen) {
        video.msRequestFullscreen();
    }
}
