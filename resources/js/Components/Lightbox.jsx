import React from "react";
import { createPortal } from "react-dom";

const Lightbox = ({
    isOpen,
    onClose,
    images,
    currentIndex,
    setCurrentIndex,
}) => {
    if (!isOpen) return null;

    const handlePrev = () => {
        setCurrentIndex((currentIndex - 1 + images.length) % images.length);
    };

    const handleNext = () => {
        setCurrentIndex((currentIndex + 1) % images.length);
    };

    return createPortal(
        <div className="lightbox-overlay">
            <div className="lightbox">
                <button className="lightbox-close" onClick={onClose}>
                    &times;
                </button>
                <button className="lightbox-prev" onClick={handlePrev}>
                    &#10094;
                </button>
                <img
                    src={images[currentIndex]}
                    alt=""
                    className="lightbox-image"
                />
                <button className="lightbox-next" onClick={handleNext}>
                    &#10095;
                </button>
            </div>
        </div>,
        document.body
    );
};

export default Lightbox;
