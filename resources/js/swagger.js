import SwaggerUI from "swagger-ui";
import "swagger-ui/dist/swagger-ui.css";

if (process.env.MIX_APP_ENV === "local") {
    SwaggerUI({
        dom_id: "#swagger-api",
        url: "/local-api.yaml",
    });
} else {
    SwaggerUI({
        dom_id: "#swagger-api",
        url: "/api.yaml",
    });
}
