function imageClick(jsonData) {
    document.getElementById("exampleModalLabel").innerHTML = `${jsonData.name}`
    document.getElementById("content").innerHTML = jsonData.content
    getHeight().innerHTML = jsonData.height
    getWeight().innerHTML = jsonData.weight
    document.getElementById("tribe").innerHTML = jsonData.tribe_name
    document.getElementById("season").innerHTML = jsonData.season_name
    document.getElementById("attack").innerHTML = jsonData.attack
    document.getElementById("defense").innerHTML = jsonData.defense
    document.getElementById("ability").innerHTML = jsonData.ability
    document.getElementById("popularity").innerHTML = jsonData.popularity

    if (jsonData.height == null) {
        getHeight().innerHTML = "未登録"
    }

    if (jsonData.weight == null) {
        getWeight().innerHTML = "未登録"
    }


    for (let i = 0; i < 5; i++) {
        const imgSrc = document.getElementById(`imageList_${i}`)
        imgSrc.setAttribute("src", "")
        imgSrc.style.visibility = "hidden"
    }
    // 登録画像がない場合
    if (jsonData.image_path = "http://127.0.0.1:8000/storage/img/noimage.png") {
        const noImage = document.getElementById("imageList_0")
        noImage.setAttribute("src", "http://127.0.0.1:8000/storage/img/noimage.png")
        noImage.style.visibility = "visible"
    }

    // 登録画像表示
    const images = jsonData.image
    for (let i = 0; i < images.length; i++) {
        const characterImage = document.getElementById(`imageList_${i}`)
        characterImage.setAttribute("src", images[i].image_path)
        characterImage.style.visibility = "visible"
    }
}



function getHeight() {
    return document.getElementById("height")
}

function getWeight() {
    return document.getElementById("weight")
}
