import React, { useState } from "react";
import Layout from "../Components/Layout";
import InfiniteScroll from "react-infinite-scroll-component";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import { format } from "date-fns";

const News = ({ initialArticles, filters }) => {
    const [articles, setArticles] = useState(initialArticles?.data || []);
    const [nextPageUrl, setNextPageUrl] = useState(
        initialArticles?.next_page_url || null
    );
    const [hasMore, setHasMore] = useState(!!initialArticles?.next_page_url);
    const [expandedArticles, setExpandedArticles] = useState({});

    const fetchMoreArticles = async () => {
        if (!hasMore || !nextPageUrl) return;

        try {
            const response = await axios.get(nextPageUrl, {
                headers: {
                    Accept: "application/json",
                },
            });
            const data = response.data;

            setArticles((prevArticles) => [...prevArticles, ...data.data]);
            setNextPageUrl(data.next_page_url);
            setHasMore(!!data.next_page_url);
        } catch (error) {
            console.error("Error fetching more articles:", error);
        }
    };

    const handleSearch = (event) => {
        Inertia.get(
            "/news",
            { search: event.target.value, date: filters.date },
            { preserveState: true }
        );
    };

    const handleDateChange = (event) => {
        Inertia.get(
            "/news",
            { search: filters.search, date: event.target.value },
            { preserveState: true }
        );
    };

    const toggleExpand = (index) => {
        setExpandedArticles((prev) => ({
            ...prev,
            [index]: !prev[index],
        }));
    };

    const truncateContent = (content, limit = 200) => {
        if (content.length <= limit) return content;
        return content.slice(0, limit) + "...";
    };

    const formatDateTime = (dateString) => {
        return format(new Date(dateString), "hh:mmaaa dd MMMM yyyy");
    };

    return (
        <Layout>
            <div
                className="container"
                style={{ width: "70%", margin: "0px auto" }}
            >
                <div className="row mt-4 mb-2">
                    <div className="col-md-4">
                        <h1>News</h1>
                    </div>
                    <div className="col-md-4">
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Search"
                            defaultValue={filters.search}
                            onChange={handleSearch}
                        />
                    </div>
                    <div className="col-md-4">
                        <input
                            type="date"
                            className="form-control"
                            defaultValue={filters.date}
                            onChange={handleDateChange}
                        />
                    </div>
                </div>
                <div className="row mb-5">
                    <div
                        className="col-md-8"
                        style={{
                            maxHeight: "80vh",
                            overflowY: "auto",
                            overflowX: "hidden",
                            scrollbarWidth: "none",
                        }}
                    >
                        <div className="card">
                            <InfiniteScroll
                                dataLength={articles.length}
                                next={fetchMoreArticles}
                                hasMore={hasMore}
                                loader={<h4>Loading...</h4>}
                                endMessage={<p>No more articles</p>}
                                scrollableTarget="scrollableDiv"
                            >
                                {articles.map((article, index) => (
                                    <div className="p-3" key={index}>
                                        <h3 className="card-title">
                                            {article.title}
                                        </h3>
                                        <p className="card-text">
                                            By {article.user}{" "}
                                            {formatDateTime(
                                                article.published_at
                                            )}
                                        </p>
                                        <div
                                            className="card-img-top my-4"
                                            style={{
                                                backgroundImage: `url(${article.image})`,
                                                height: "200px",
                                                backgroundSize: "cover",
                                                backgroundPosition: "center",
                                            }}
                                        />
                                        <div
                                            dangerouslySetInnerHTML={{
                                                __html: expandedArticles[index]
                                                    ? article.content
                                                    : truncateContent(
                                                          article.content
                                                      ),
                                            }}
                                            className="mb-2"
                                        />
                                        {article.content.length > 200 && (
                                            <button
                                                onClick={() =>
                                                    toggleExpand(index)
                                                }
                                                className="btn btn-link mt-2"
                                            >
                                                {expandedArticles[index]
                                                    ? "Show less"
                                                    : "Read more"}
                                            </button>
                                        )}
                                    </div>
                                ))}
                            </InfiniteScroll>
                        </div>
                    </div>
                    <div
                        className="col-md-4"
                        style={{
                            maxHeight: "80vh",
                            overflowY: "auto",
                            overflowX: "hidden",
                            scrollbarWidth: "none",
                        }}
                    >
                        <h4>Latest</h4>
                        <div className="card mb-5">
                            {articles.slice(0, 5).map((article, index) => (
                                <div key={index} className="p-3">
                                    <h5 className="card-title">
                                        {article.title}
                                    </h5>
                                    <div
                                        className="card-img-top"
                                        style={{
                                            backgroundImage: `url(${article.image})`,
                                            height: "200px",
                                            backgroundSize: "cover",
                                            backgroundPosition: "center",
                                        }}
                                    />
                                    <div
                                        dangerouslySetInnerHTML={{
                                            __html: expandedArticles[index]
                                                ? article.content
                                                : truncateContent(
                                                      article.content
                                                  ),
                                        }}
                                    />
                                    {article.content.length > 200 && (
                                        <button
                                            onClick={() => toggleExpand(index)}
                                            className="btn btn-link"
                                        >
                                            {expandedArticles[index]
                                                ? "Show less"
                                                : "Read more"}
                                        </button>
                                    )}
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    );
};

export default News;
