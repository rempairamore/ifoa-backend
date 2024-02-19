const urlSito = 'https://justatip.it/wp-json/wp/v2/'


async function salvaPosts() {
    // Mostra lo spinner
    document.getElementById('loadingSpinner').style.display = 'block';

    await fetch(urlSito+'posts/?page=2&per_page=18')
    .then(response => response.json())
    .then(json => {
        creazioneIndex(JSON.stringify(json));
        // Nascondi lo spinner dopo il caricamento dei dati
        document.getElementById('loadingSpinner').style.display = 'none';
    })
    .catch(error => {
        console.error('Error fetching data: ', error);
        // Nascondi lo spinner anche in caso di errore
        document.getElementById('loadingSpinner').style.display = 'none';
    });
}


function creazioneIndex(nuoviPosts) {
    localStorage.setItem('posts', nuoviPosts);
    const posts = JSON.parse(localStorage.getItem('posts'));
    console.log(posts);
    let spazioPosts = document.querySelector('#spazioPosts');
    
    posts.forEach(post => {
        let nuovoFiglio = document.createElement('div');
        nuovoFiglio.className = 'col';
        nuovoFiglio.innerHTML = `
            <div class="card h-100">
            <img src="${post.jetpack_featured_media_url}" class="card-img-top" alt="immagine card">
            <div class="card-body">
            <h5 class="card-title">${post.title.rendered}</h5>
            <p class="card-text">${post.excerpt.rendered}</p>
            <a href="post.html?articleName=${post.slug}" class="btn btn-primary">Leggi Articolo</a>
            </div>
        </div>
        `
        spazioPosts.appendChild(nuovoFiglio);
    });
}


function letturaQueryStringPost() {
    const urlParams = new URLSearchParams(document.location.search);
    const slugGood = urlParams.get('articleName')
    let tuttiPosts = JSON.parse(localStorage.getItem('posts'));
    let postGood = tuttiPosts.filter((tuttiPosts) => tuttiPosts.slug == slugGood);
    localStorage.setItem('singolPost', JSON.stringify(postGood));

    creazionePostNelPost();

}


function creazionePostNelPost() {
    let divPost = document.querySelector('#mioPost');
    let mioPost = JSON.parse(localStorage.getItem('singolPost'));
    console.log(mioPost[0]);
    divPost.innerHTML = `
        <h1 class="my-3 mx-4">${mioPost[0].title.rendered}</h1>
        <br>
        <div class="mx-4">${mioPost[0].content.rendered}</div>
    `

}


// Cosa succede se vado nella home page 
if(document.location.pathname === '/index.html' || document.location.pathname === '/') {
    salvaPosts();
}

// Cosa succede se vado sulla pagina post 
if(document.location.pathname === '/post.html') {

    letturaQueryStringPost();
}



