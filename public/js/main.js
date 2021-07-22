window.addEventListener("load", () => {
    const url = location.origin;

    const btnsLike = document.getElementsByClassName("btn-like");
    const btnsDislike = document.getElementsByClassName("btn-dislike");

    Array.from(btnsLike).forEach((btnLike) => {
        btnLike.addEventListener("click", () => {
            const imageId = btnLike.getAttribute("imageId");

            fetch(`${url}/like/delete/${imageId}`, { method: "get" })
                .then((res) => res.json())
                .then((res) => {
                    console.log(res);
                    location.reload();
                });
        });
    });

    Array.from(btnsDislike).forEach((btnDislike) => {
        btnDislike.addEventListener("click", () => {
            const imageId = btnDislike.getAttribute("imageId");

            fetch(`${url}/like/save/${imageId}`, { method: "get" })
                .then((res) => res.json())
                .then((res) => {
                    console.log(res);
                    location.reload();
                });
        });
    });
});
