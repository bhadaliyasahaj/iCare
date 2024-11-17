document.getElementById("submitBtn").addEventListener("click", function (event) {

        if(!(document.getElementById("agree").checked)){
        alert("please agree the term and condition");
        return;
    }
});