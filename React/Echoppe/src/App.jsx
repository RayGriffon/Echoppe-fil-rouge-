import React, { useEffect, useState } from 'react';
import ProductList from './components/ProductList';
import ProductForm from './components/ProductForm';

const App = () => {
  const [products, setProducts] = useState([]);
  const [editingProduct, setEditingProduct] = useState(null);

  useEffect(() => {
    fetch('https://nathan.amorce.org/api/produits')
      .then(response => response.json())
      .then(data => {
        if (Array.isArray(data['hydra:member'])) {
          setProducts(data['hydra:member']);
        } else {
          console.log('Données des produits invalides:', data);
        }
      })
      .catch(error => {
        console.log('Erreur lors de la récupération des produits:', error);
      });
  }, []);

  const handleCreateProduct = product => {
    fetch('https://nathan.amorce.org/api/produits', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(product),
    })
      .then(response => response.json())
      .then(data => {
        setProducts([...products, data]);
      })
      .catch(error => {
        console.log('Erreur lors de la création du produit:', error);
      });
  };

  const handleEditProduct = (productId, updatedProduct) => {
    fetch(`https://nathan.amorce.org${productId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(updatedProduct),
    })
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Erreur lors de la mise à jour du produit');
        }
      })
      .then(data => {
        setProducts(products.map(p => (p['@id'] === data['@id'] ? data : p)));
        setEditingProduct(null);
      })
      .catch(error => {
        console.log('Erreur lors de la mise à jour du produit:', error);
      });
  };

  const handleDeleteProduct = productId => {
    fetch(`https://nathan.amorce.org${productId}`, {
      method: 'DELETE',
    })
      .then(response => {
        if (response.ok) {
          setProducts(products.filter(p => p['@id'] !== productId));
        } else {
          console.log('Erreur lors de la suppression du produit:', response.statusText);
        }
      })
      .catch(error => {
        console.log('Erreur lors de la suppression du produit:', error);
      });
  };

  const handleEdit = id => {
    const productToEdit = products.find(product => product['@id'] === id);
    setEditingProduct(productToEdit);
  };

  const handleCancelEdit = () => {
    setEditingProduct(null);
  };

  return (
    <div>
      <h1>Liste des produits</h1>
      <ProductList
        products={products}
        onDeleteProduct={handleDeleteProduct}
        onEditProduct={handleEdit}
      />
      <h2>{editingProduct ? 'Modifier le produit' : 'Créer un produit'}</h2>
      <ProductForm
        onSubmit={editingProduct ? (updatedProduct) => handleEditProduct(editingProduct['@id'], updatedProduct) : handleCreateProduct}
        onCancel={handleCancelEdit}
        editedProduct={editingProduct}
      />
    </div>
  );
};

export default App;
