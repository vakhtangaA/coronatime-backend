require("./bootstrap");
import persist from "@alpinejs/persist";
import Alpine from "alpinejs";

Alpine.plugin(persist);

window.Alpine = Alpine;

Alpine.start();
