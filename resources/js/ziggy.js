const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"password\/reset","methods":["POST"]},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"]},"home":{"uri":"home","methods":["GET","HEAD"]},"product.paginate":{"uri":"product\/paginate","methods":["GET","HEAD"]},"product.json":{"uri":"product\/json","methods":["GET","HEAD"]},"product.index":{"uri":"product","methods":["GET","HEAD"]},"product.create":{"uri":"product\/create","methods":["GET","HEAD"]},"product.store":{"uri":"product","methods":["POST"]},"product.show":{"uri":"product\/{product}","methods":["GET","HEAD"],"bindings":{"product":"id"}},"product.edit":{"uri":"product\/{product}\/edit","methods":["GET","HEAD"],"bindings":{"product":"id"}},"product.update":{"uri":"product\/{product}","methods":["PUT","PATCH"],"bindings":{"product":"id"}},"product.destroy":{"uri":"product\/{product}","methods":["DELETE"],"bindings":{"product":"id"}},"delivery.paginate":{"uri":"delivery\/paginate","methods":["GET","HEAD"]},"delivery.index":{"uri":"delivery","methods":["GET","HEAD"]},"delivery.create":{"uri":"delivery\/create","methods":["GET","HEAD"]},"delivery.store":{"uri":"delivery","methods":["POST"]},"delivery.show":{"uri":"delivery\/{delivery}","methods":["GET","HEAD"],"bindings":{"delivery":"id"}},"delivery.edit":{"uri":"delivery\/{delivery}\/edit","methods":["GET","HEAD"],"bindings":{"delivery":"id"}},"delivery.update":{"uri":"delivery\/{delivery}","methods":["PUT","PATCH"],"bindings":{"delivery":"id"}},"delivery.destroy":{"uri":"delivery\/{delivery}","methods":["DELETE"],"bindings":{"delivery":"id"}},"reject.paginate":{"uri":"reject\/paginate","methods":["GET","HEAD"]},"reject.index":{"uri":"reject","methods":["GET","HEAD"]},"reject.create":{"uri":"reject\/create","methods":["GET","HEAD"]},"reject.store":{"uri":"reject","methods":["POST"]},"reject.show":{"uri":"reject\/{reject}","methods":["GET","HEAD"],"bindings":{"rejectProduct":"id"}},"reject.edit":{"uri":"reject\/{reject}\/edit","methods":["GET","HEAD"]},"reject.update":{"uri":"reject\/{reject}","methods":["PUT","PATCH"]},"reject.destroy":{"uri":"reject\/{reject}","methods":["DELETE"]},"stock.index":{"uri":"stock","methods":["GET","HEAD"]},"stock.paginate":{"uri":"stock\/paginate","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };