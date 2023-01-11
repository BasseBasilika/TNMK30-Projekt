function inspectSet(setID) {
    window.location.href = "../Lego%20hemsida/result.php?set=" + setID;
}

function Searchhelp() {

    if (document.getElementById("infotexthelp").style.display == "block") {

        document.getElementById("infotexthelp").style.display = "none";
    }
    else {
        document.getElementById("infotexthelp").style.display = "block";

    }
}