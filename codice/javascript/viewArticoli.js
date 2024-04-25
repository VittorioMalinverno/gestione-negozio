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