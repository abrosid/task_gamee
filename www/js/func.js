function singleRequest() {
    var json = {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 1, "score": 10}, "id": 4};
    var settings = {
        "url": basePath + '/api/main',
        "method": "POST",
        "headers": {
            "Content-Type": "application/json",
            "Cache-Control": "no-cache",
        },
        "data": JSON.stringify(json)
    }
    $.ajax(settings).done(function (response) {
        $('#singleResponse').html("Response: " + JSON.stringify(response));
    });
}

function badSingleRequest() {
    var json = {"jsonrpc": "2.0", "method": "score", "params": [], "id": 4};
    var settings = {
        "url": basePath + '/api/main',
        "method": "POST",
        "headers": {
            "Content-Type": "application/json",
            "Cache-Control": "no-cache",
        },
        "data": JSON.stringify(json)
    }
    $.ajax(settings).done(function (response) {
        $('#badSingleResponse').html("Response: " + JSON.stringify(response));
    });
}

function badParamSingleRequest() {
    var json = {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 1}, "id": 4};
    var settings = {
        "url": basePath + '/api/main',
        "method": "POST",
        "headers": {
            "Content-Type": "application/json",
            "Cache-Control": "no-cache",
        },
        "data": JSON.stringify(json)
    }
    $.ajax(settings).done(function (response) {
        $('#badParamSingleResponse').html("Response: " + JSON.stringify(response));
    });
}

function batchRequest() {
    var json = [
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 0, "score": 2100}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 1, "score": 2101}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 2, "score": 2102}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 3, "score": 2103}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 4, "score": 2104}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 5, "score": 2105}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 6, "score": 2106}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 7, "score": 2107}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 8, "score": 2108}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 9, "score": 2109}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 10, "score": 1100}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 11, "score": 1101}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 12, "score": 1102}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 13, "score": 1103}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 14, "score": 1104}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 15, "score": 1105}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 16, "score": 1106}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 17, "score": 1107}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 18, "score": 1108}, "id": 4},
        {"jsonrpc": "2.0", "method": "score", "params": {"gameId": 1, "userId": 19, "score": 1109}, "id": 4}
    ];
    var settings = {
        "url": basePath + '/api/main',
        "method": "POST",
        "headers": {
            "Content-Type": "application/json",
            "Cache-Control": "no-cache",
        },
        "data": JSON.stringify(json)
    }
    $.ajax(settings).done(function (response) {
        $('#batchResponse').html("Response: " + JSON.stringify(response));
    });
}

function toptenRequest() {
    var json = {"jsonrpc": "2.0", "method": "topten", "params": {"gameId": 1}, "id": 4};
    var settings = {
        "url": basePath + '/api/main',
        "method": "POST",
        "headers": {
            "Content-Type": "application/json",
            "Cache-Control": "no-cache",
        },
        "data": JSON.stringify(json)
    }
    $.ajax(settings).done(function (response) {
        $('#toptenResponse').html("Response: " + JSON.stringify(response));
    });
}
