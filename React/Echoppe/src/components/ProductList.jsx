import React from 'react';

const ProductList = ({ products, onDeleteProduct, onEditProduct }) => {

  const handleEdit = (id) => {
    onEditProduct(id);
  };

  const handleDelete = (id) => {
    onDeleteProduct(id);
  };

  return (
    <div>
      {products.length > 0 ? (
        <table>
          <thead>
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Prix</th>
              <th>TVA</th>
              <th>Référence</th>
              <th>En ligne</th>
              <th>Fournisseur</th>
              <th>Catégories</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {products.map(product => (
              <tr key={product['@id']}>
                <td>{product.nomProduit}</td>
                <td>{product.descriptionProduit}</td>
                <td>{product.prixProduit}</td>
                <td>{product.tvaProduit}</td>
                <td>{product.refProduit}</td>
                <td>{product.isOnline ? 'Oui' : 'Non'}</td>
                <td>{product.fournisseur ? product.fournisseur.id : ''}</td>
                <td>
                  {product.categories.length > 0
                    ? product.categories.map(category => category.id).join(', ')
                    : ''}
                </td>
                <td>
                  <button onClick={() => handleEdit(product['@id'])}>Modifier</button>
                  <button onClick={() => handleDelete(product['@id'])}>Supprimer</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      ) : (
        <p>Aucun produit disponible.</p>
      )}
    </div>
  );
};

export default ProductList;
