const activeCU = "IPED"  

var logo1Src = null, CU_name = null, CU_shortName = null, CU_sector = null, pColor = null, sColor = null;

switch (activeCU) {
    case "DAI":
        logo1Src = "assets/img/logos/dai_wt.png",
        logo2Src = "assets/img/logos/dai_t.png",
        CU_name = "DAI",
        CU_shortName = "DAI",
        CU_sector = "Livestock",
        pColor = "#56687b",
        sColor = "#445560";
        break;
        
    case "IPED":
        logo1Src = "assets/img/logos/iped_logo.png",
        logo2Src =  "assets/img/logos/iped_logo.png",
        CU_name = "IPED Guyana",
        CU_shortName = "IPED",
        CU_sector = "Livestock",
        pColor = "#858796",
        sColor = "#DB4437";
        textColor = "#F8F9FC";
        break;

    case "TTCU":
        logo1Src = "assets/img/logos/TTCU_logo.png",
        logo2Src = "assets/img/logos/TTCU_logo.png",
        CU_name = "Toledo Teachers Credit Union",
        CU_shortName = "TTCU"
        CU_sector = "Agriculture & Fisheries";
        pColor = "#5575cc",
        sColor = "#5575cc";
        break;

    case "SFXCU":
        logo1Src = "assets/img/logos/SFXCU_logo.png",
        logo2Src = "assets/img/logos/SFXCU_logo.png",
        CU_name = "St. Francis Xavier Credit Union",
        CU_shortName = "SFXCU"
        CU_sector = "Agriculture & Fisheries",
        pColor = "#2e9669",
        sColor = "#DD9932";
        break;

    default:
        break;
}

function applyThemeConfig(){
    
    // apply logo src to class
    $(".logo1Placeholder").attr("src",logo1Src);
    $(".logo2Placeholder").attr("src",logo2Src);
    

    // apply bg color to class
    $(".bg-gradient-primary").css("background-color", pColor);
    $(".float").css("background-color", "#bf4f51 ");
    var imageUrl = "assets/img/flooding2.jpg";
    $(".sidebar-dark .nav-item .nav-link").css("color", textColor)
    //$(".sidebar-dark .nav-item .nav-link i").css("color", )
    //$(".bg-gradient-primary").css('background-image', 'url(' + imageUrl + ')');

    // setting CU name inside placeholders that match class 
    $(".CU_name").text(CU_name);
    



}