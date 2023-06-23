import React, { useState } from 'react';
import ProductForm from './ProductForm';

const ProductEdit = ({ product, onSave, onCancel }) => {
    const [editedProduct, setEditedProduct] = useState(product);

    const handleFormSubmit = updatedProduct => {
        onSave(editedProduct['@id'], updatedProduct);
        };      

    return (
        <div>
            <h2>Modifier le produit</h2>
            <ProductForm onSubmit={handleFormSubmit} onCancel={onCancel} editedProduct={editedProduct} />
        </div>
    );
};

export default ProductEdit;
