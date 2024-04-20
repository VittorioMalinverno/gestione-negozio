//fetch per recuperare tutti i prodotti presenti nel db
export const recuperaProdotti = () => {
    return new Promise((resolve, reject) => {
        fetch("../php/viewArticoli.php", {
            method: "Post",
            headers: {
                "content-type": "application/json",
            },
        })
            .then((element) => {
                element.json();
            }).then((response) => {
                resolve(response);
            })
            .catch((error) => reject(error));
    });
};