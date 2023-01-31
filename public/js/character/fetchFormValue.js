// キャラクター名
function getName() {
    const name = document.getElementById("name").value
    return name
}

function getErrorMsgName() {
    const errorMsgName = document.querySelector(".err-msg-name")
    return errorMsgName
}


// キャラクター説明
function getContent() {
    const content = document.getElementById("content").value
    return content
}

function getErrorMsgContent() {
    const errorMsgContent = document.querySelector(".err-msg-content")
    return errorMsgContent
}


// 身長
function getHeight() {
    const height = document.getElementById("height").value
    return height
}

function getErrorMsgHeight() {
    const errorMsgHeight = document.querySelector(".err-msg-height")
    return errorMsgHeight
}


// 体重
function getWeight() {
    const weight = document.getElementById("weight").value
    return weight
}

function getErrorMsgWeight() {
    const errorMsgWeight = document.querySelector(".err-msg-weight")
    return errorMsgWeight
}



// カテゴリー
function getTribe() {
    const tribe = document.getElementById("tribe").value
    return tribe
}

function getErrorMsgTribe() {
    const errorMsgTribe = document.querySelector(".err-msg-tribe")
    return errorMsgTribe
}



// シーズン
function getSeason() {
    const season = document.getElementById("season").value
    return season
}

function getErrorMsgSeason() {
    const errorMsgSeason = document.querySelector(".err-msg-season")
    return errorMsgSeason
}


// 攻撃
function getAttack() {
    const attack = document.getElementById("attack").value
    return attack
}
function getErrorMsgAttack() {
    const errorMsgAttack = document.querySelector(".err-msg-attack")
    return errorMsgAttack
}

// 守備
function getDefence() {
    const defence = document.getElementById("defence").value
    return defence
}
function getErrorMsgDefence() {
    const errorMsgDefence = document.querySelector(".err-msg-defence")
    return errorMsgDefence
}

// 潜在能力
function getAbility() {
    const ability = document.getElementById("ability").value
    return ability
}
function getErrorMsgAbility() {
    const errorMsgAbility = document.querySelector(".err-msg-ability")
    return errorMsgAbility
}

// 人気度
function getPopularity() {
    const popularity = document.getElementById("popularity").value
    return popularity
}
function getErrorMsgPopularity() {
    const errorMsgPopularity = document.querySelector(".err-msg-popularity")
    return errorMsgPopularity
}

// radioチェック
function getRadioCheckNo() {
    const radioCheckNo = document.getElementById("chkNo")
    return radioCheckNo
}

function getRadioCheckYes() {
    const radioCheckYes = document.getElementById("chkYes")
    return radioCheckYes
}

// characteridを取得
function getCharacterId() {
    return document.getElementById("characterId").value
}


