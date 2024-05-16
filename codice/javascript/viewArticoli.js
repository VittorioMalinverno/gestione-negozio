//fetch per recuperare tutti i prodotti presenti nel db
export const recuperaProdotti = () => {
    return new Promise((resolve, reject) => {
        fetch("../servizi/viewArticoli.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
        })
            .then((element) => {
                return element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
};

export const recuperaOrdini = (email) => {
    return new Promise((resolve, reject) => {
        fetch("../servizi/recuperaOrdini.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
            body: JSON.stringify({email: email})
        })
            .then((element) => {
                return element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
};

export const creaOrdini = (lista_ordini) => {
    console.log("Nella fgetch");
    console.log(lista_ordini);
    return new Promise((resolve, reject) => {
        fetch("../servizi/creaOrdine.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
            body: JSON.stringify(lista_ordini)
        })
            .then((element) => {
                return element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
};

export const recuperaQuantitaVenduta = ()=>{
    return new Promise((resolve, reject) => {
        fetch("../servizi/prodottoVenduto.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
        })
            .then((element) => {
                return element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
}

export const login = (dizionario) =>{
    console.log(dizionario);
    return new Promise((resolve, reject) => {
        fetch("../servizi/login.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
            body: JSON.stringify(dizionario)
        })
            .then((element) => {
                return element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
}

export const registrati = (dizionario) =>{
    console.log(dizionario);
    return new Promise((resolve, reject) => {
        fetch("../servizi/registrati.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
            body: JSON.stringify(dizionario)
        })
            .then((element) => {
                return element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
}