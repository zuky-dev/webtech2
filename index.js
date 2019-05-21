const del = require('del');

function dlt(){
    del(['./.cache/**', './dist/**']).then(paths => {
        console.log('Deleted parcel cached files\n');
    });
}

function strt(){
    
}

function bld(){
    
}
