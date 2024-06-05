$(document).ready(() => {
    $("#banner1").hide();
    $("#banner2").hide();

    const $banners = [$("#banner"), $("#banner1"), $("#banner2")];
    let currentIndex = 0;
    const intervalTime = 3000; // 3 seconds

    const showBanner = (index) => {
        $banners.forEach(($banner, i) => {
            if (i === index) {
                $banner.show();
            } else {
                $banner.hide();
            }
        });
    };

    $("#next1, #next2, #next3").on("click", () => {
        currentIndex = (currentIndex + 1) % $banners.length;
        showBanner(currentIndex);
    });

    $("#prev1, #prev2, #prev3").on("click", () => {
        currentIndex = (currentIndex - 1 + $banners.length) % $banners.length;
        showBanner(currentIndex);
    });

    // Initial display
    showBanner(currentIndex);

    // Set interval for automatic movement
    setInterval(() => {
        $("#next1").click();
    }, intervalTime);
});