self.onmessage = (url) => {
    var source = new EventSource(url.data);
    source.onmessage = (event) => {
        self.postMessage(event.data);
    };
};