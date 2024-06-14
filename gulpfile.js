const gulp = require("gulp");
const { spawn } = require("child_process");
const browserSync = require("browser-sync").create();

function startPHP(done) {
    const phpServer = spawn("php", ["-S", "localhost:8010", "-t", "src"]);

    phpServer.stdout.on("data", (data) => {
        console.log(`stdout: ${data}`);
    });

    phpServer.stderr.on("data", (data) => {
        console.error(`stderr: ${data}`);
    });

    process.on("exit", () => {
        phpServer.kill();
    });

    done();
}

function startBrowserSync(done) {
    browserSync.init({
        proxy: "localhost:8010",
        port: 8080,
        open: true,
        notify: false,
        browser: "chrome",
    });

    gulp.watch("src/**/*.php").on("change", browserSync.reload);
    gulp.watch("src/css/*.css").on("change", browserSync.stream);

    done();
}

gulp.task("default", gulp.series(startPHP, startBrowserSync));
