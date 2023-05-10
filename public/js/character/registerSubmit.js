window.addEventListener('DOMContentLoaded', () => {

    const btnSubmit = document.getElementById("btnSubmit")
    const loadingGifSubmit = document.getElementById("loading-area__submit")

    btnSubmit.addEventListener("click", (e) => {
        let base64Images = new Array();
        btnChangeLoading(btnSubmit, loadingGifSubmit)
        let validations = "ture"


        // キャラクター名バリデーション
        if (nameValidate() == false) {
            validations = false
        }

        // キャラクター説明バリデーション
        if (!contentValidate()) {
            validations = false
        }

        // 身長バリデーション
        if (heightValidate() == false) {
            validations = false
        }

        // 体重バリデーション
        if (weightValidate() == false) {
            validations = false
        }

        // 図鑑番号バリデーション
        if (numberValidate() == false) {
            validations = false
        }

        // カテゴリーバリデーション
        if (tribeValidate() == false) {
            validations = false
        }

        // シーズンバリデーション
        if (seasonValidate() == false) {
            validations = false
        }

        // 攻撃バリデーション
        if (attackValidate() == false) {
            validations = false
        }

        // 守備バリデーション
        if (defenseValidate() == false) {
            validations = false
        }

        // 潜在能力バリデーション
        if (abilityValidate() == false) {
            validations = false
        }

        // 人気度バリデーション
        if (popularityValidate() == false) {
            validations = false
        }

        if (validations == false) {
            loadingChangeBtn(btnSubmit, loadingGifSubmit)
            return
        }


        // base64形式で画像データを配列で取得する
        const imageDatas = document.getElementsByClassName("preview-img")
        Array.from(imageDatas).forEach((data) => {
            base64Images.push(data.src)
        })

        const radioCheckNo = getRadioCheckNo()
        const radioCheckYes = getRadioCheckYes()
        // 画像なしが選択されていたら
        if (radioCheckNo.checked) {
            let param = {
                name: getName(),
                content: getContent(),
                height: getHeight(),
                weight: getWeight(),
                number: getNumber(),
                tribe_id: getTribe(),
                season_id: getSeason(),
                attack: getAttack(),
                defense: getDefence(),
                ability: getAbility(),
                popularity: getPopularity(),
            }

            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "/character",
                type: "POST",
                data: param,
            })
                // Ajaxリクエストが成功した時発動
                .done((data) => {
                    if (data.successMessage) {
                        showSweetAlert("success", data.successMessage)
                        window.setTimeout(function () {
                            window.location.href = ("/character")
                        }, 3000);
                    }
                    if (data.errorMessage) {
                        showSweetAlert("error", data.errorMessage)
                        loadingChangeBtn(btnSubmit, loadingGifSubmit)
                        return
                    }
                })
                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    showSweetAlert("error", data.errorMessage)
                    loadingChangeBtn(btnSubmit, loadingGifSubmit)
                    return
                })
            // Ajaxリクエストが成功・失敗どちらでも発動

        }
        // 画像ありが選択されていたら
        if (radioCheckYes.checked) {
            let param = {
                name: getName(),
                content: getContent(),
                height: getHeight(),
                weight: getWeight(),
                number: getNumber(),
                tribe_id: getTribe(),
                season_id: getSeason(),
                attack: getAttack(),
                defense: getDefence(),
                ability: getAbility(),
                popularity: getPopularity(),
                image: base64Images,
            }
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "./character",
                type: "POST",
                data: param,
            })
                // Ajaxリクエストが成功した時発動
                .done((data) => {
                    if (data.successMessage) {
                        showSweetAlert("success", data.successMessage)
                        window.setTimeout(function () {
                            window.location.href = ("/character")
                        }, 3000);
                    }
                    if (data.errorMessage) {
                        showSweetAlert("error", data.errorMessage)
                        loadingChangeBtn(btnSubmit, loadingGifSubmit)
                        return
                    }
                })
                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    showSweetAlert("error", data.errorMessage)
                    loadingChangeBtn(btnSubmit, loadingGifSubmit)
                    return
                })
            // Ajaxリクエストが成功・失敗どちらでも発動
        }
    }, false);

}, false);



