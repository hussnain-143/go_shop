export function getUrl() {
    const BaseUrl = "http://127.0.0.1:8000/api";
    return {
        getHeaderCategoryData: "" + BaseUrl + "/homepage_category",
        getHomeData: "" + BaseUrl + "/homepage",
        getCategoryData: "" + BaseUrl + "/category_data/",

    };
}
export default getUrl;
