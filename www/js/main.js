




$(() => {
    var rr = [
        {
            jsonrpc: "2.0",
            method: "score",
            params: {
                gameId: 23,
                userId: 42,
                score: 4
            },
            id: 3
        },
        {
            jsonrpc: "2.0",
            method: "subtract",
            params: {
                gameId: 3,
                userId: 2,
                score: 4
            },
            id: 5
        }
    ];
    var r = {
        jsonrpc: "2.0",
        method: "topten",
        params: {
            gameId: 3,
            userId: 2,
            score: 4
        },
        id: 3
    };



    $("#jsonTest1").click(() => {
        $.ajax({
            type: "POST",
            url: basePath + '/api/main',
            contentType: 'application/json',
            dataType: 'text',
            data: JSON.stringify(rr),
            success: (data) => {
                console.dir(data);
            },
            error: (data) => {
                console.dir(data);
            }
        }).done((data) => {
            console.dir(data);
        });
    });

    $("#jsonTest2").click(() => {
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": basePath + '/api/main',
            "method": "POST",
            "headers": {
                "Cache-Control": "no-cache",
//                "Postman-Token": "5c220044-5552-4d51-b946-f3a0caa2a01f"
            },
            "data": JSON.stringify([
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 0, "score": 100}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 1, "score": 110}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 2, "score": 120}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 3, "score": 130}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 4, "score": 140}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 5, "score": 150}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 6, "score": 160}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 7, "score": 170}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 8, "score": 180}, "id": 4},
                {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 9, "score": 190}, "id": 4}
            ])
        }

        $.ajax(settings).done(function (response) {
            console.log(response);
        });

//        $.ajax({
//            type: "POST",
//            url: basePath + '/api/main',
//            contentType: 'application/json',
//            dataType: 'text',
//            data: JSON.stringify(r),
//            success: (data) => {
//                console.dir(data);
//            },
//            error: (data) => {
//                console.dir(data);
//            }
//        }).done((data) => {
//            console.dir(data);
//        });
    });

});
