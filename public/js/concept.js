    // Routing for multi-page concept
    function showTab(tabId) {
      // Determine the base path based on whether we are in a subfolder or root
      const isSubfolder = window.location.pathname.includes('/user/') || window.location.pathname.includes('/admin/');
      let prefix = '';
      if (isSubfolder) {
        prefix = '../';
      }

      const routes = {
        'landing': 'home.html',
        'donor': 'user/donor.html',
        'catalog': 'user/catalog.html',
        'detail': 'user/claim.html',
        'api': 'api-docs.html',
        'admin': 'admin/dashboard.html'
      };

      if (routes[tabId]) {
        window.location.href = prefix + routes[tabId];
      }
    }

    // Initiate Claim: Click on catalog card, fill detail section, swap page
    function initiateClaim(name, origin, qtyAvailable, category, emoji) {
      document.getElementById('detailFoodEmoji').innerText = emoji;
      document.getElementById('detailFoodName').innerText = name;
      document.getElementById('detailFoodOrigin').innerText = `📍 ${origin} • donor_id: 2`;
      document.getElementById('detailFoodQty').innerText = `🍽️ ${qtyAvailable} Porsi`;
      document.getElementById('detailFoodCategory').innerText = `📂 ${category}`;
      
      // Update form max qty input
      const claimQtyInput = document.getElementById('claimQtyInput');
      claimQtyInput.max = qtyAvailable;
      claimQtyInput.value = Math.min(15, qtyAvailable);
      
      // Hide claim alert if active
      document.getElementById('claimSuccessBox').style.display = 'none';

      // Switch to detail page
      showTab('detail');
    }

    // Submit Claim Form
    function submitClaimForm(event) {
      event.preventDefault();
      
      const qty = document.getElementById('claimQtyInput').value;
      const method = document.getElementById('claimMethodSelect').value === 'delivery' ? 'Delivery' : 'Pickup';
      const notes = document.getElementById('claimNotesInput').value;
      const name = document.getElementById('detailFoodName').innerText;

      // Add to timeline tracking dynamically
      const timeline = document.getElementById('distributionTimeline');
      const timeStr = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WITA';

      const newNodeHtml = `
        <div class="timeline-node active">
          <div class="timeline-indicator"></div>
          <div class="timeline-node-content">
            <h5>Penyaluran Baru Diajukan (${method}) <span class="timeline-time">${timeStr}</span></h5>
            <p>Mengklaim <strong>${qty} porsi</strong> dari ${name}. Catatan: "${notes}"</p>
          </div>
        </div>
      `;
      
      // Reset previous timeline active status
      document.querySelectorAll('.timeline-node').forEach(node => {
        if(node.classList.contains('active')) {
          node.classList.remove('active');
          node.classList.add('done');
        }
      });

      timeline.innerHTML += newNodeHtml;

      // Add to admin validation panel queue
      const adminTable = document.getElementById('adminValidationTable');
      const newClaimId = '#KL-00' + (adminTable.children.length + 1);
      
      const newRowHtml = `
        <tr>
          <td>${newClaimId}</td>
          <td>
            <strong>${document.getElementById('detailFoodEmoji').innerText} ${name}</strong><br>
            <small class="text-muted">Restoran Sederhana</small>
          </td>
          <td>
            <strong>Panti Asuhan Harapan Bangsa</strong><br>
            <small class="text-muted">lembaga_id: 4</small>
          </td>
          <td>${qty} Porsi</td>
          <td><span class="badge-status" style="background:#FFF3D6; color:#E6A817;">Pending</span></td>
          <td class="text-center">
            <div class="d-flex gap-2 justify-content-center">
              <button class="btn-sage" onclick="processValidationRow(this, 'approved', ${qty})">✓ Setujui</button>
              <button class="btn-danger-custom" onclick="processValidationRow(this, 'rejected', 0)">✗ Tolak</button>
            </div>
          </td>
        </tr>
      `;
      adminTable.innerHTML += newRowHtml;

      // Update counters
      const pendingCounter = document.getElementById('adminStatPending');
      const pendingBadge = document.getElementById('validationPendingBadge');
      const currentPending = parseInt(pendingCounter.innerText) + 1;
      pendingCounter.innerText = currentPending;
      pendingBadge.innerText = `${currentPending} Menunggu Validasi`;

      // Show alert success box
      const successBox = document.getElementById('claimSuccessBox');
      successBox.style.display = 'block';
      successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Process Validation row in Admin Panel
    function processValidationRow(buttonElement, status, qty) {
      const row = buttonElement.closest('tr');
      const statusBadge = row.querySelector('.badge-status');
      const actionWrapper = row.querySelector('td:last-child');

      if (status === 'approved') {
        statusBadge.innerText = 'Approved';
        statusBadge.style.backgroundColor = 'var(--green-light)';
        statusBadge.style.color = 'var(--green)';
        row.style.opacity = '0.7';

        // Update overall saved portions counter
        const savedCounter = document.getElementById('adminStatPorsi');
        savedCounter.innerText = parseInt(savedCounter.innerText) + qty;
      } else {
        statusBadge.innerText = 'Rejected';
        statusBadge.style.backgroundColor = '#FCE4D6';
        statusBadge.style.color = '#C55A11';
        row.style.opacity = '0.5';
      }

      // Remove action buttons
      actionWrapper.innerHTML = `<span class="fw-bold" style="color: ${status === 'approved' ? 'var(--green)' : '#C55A11'}">${status.toUpperCase()}</span>`;

      // Lower the pending validation counter
      const pendingCounter = document.getElementById('adminStatPending');
      const pendingBadge = document.getElementById('validationPendingBadge');
      const currentPending = Math.max(0, parseInt(pendingCounter.innerText) - 1);
      pendingCounter.innerText = currentPending;
      pendingBadge.innerText = `${currentPending} Menunggu Validasi`;
    }

    // Donor Mockup - Add surplus donation
    function showInputDonasiModal() {
      // Prompt modal-like user action to represent seeder sync
      const foodName = prompt("Nama Hidangan Baru:", "Croissant Warm Choco");
      if (!foodName) return;
      const qtyStr = prompt("Jumlah Porsi:", "25");
      if (!qtyStr) return;
      const category = prompt("Kategori (makanan_berat / roti / snack / minuman):", "roti");
      if (!category) return;
      const expStr = prompt("Masa Kedaluwarsa (dalam Jam):", "8");
      if (!expStr) return;

      // Add to Mitra Donor table
      const tbody = document.getElementById('riwayatDonasiBody');
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><strong>🥐 ${foodName}</strong></td>
        <td>${qtyStr} porsi</td>
        <td><span class="category-pill">${category}</span></td>
        <td><span class="badge-status available">Available</span></td>
        <td>⏰ ${expStr} Jam Lagi</td>
      `;
      tbody.prepend(tr);

      // Add to catalog as well
      const catalogGrid = document.getElementById('catalogFoodGrid');
      const col = document.createElement('div');
      col.className = 'food-card';
      col.setAttribute('data-category', category);
      col.innerHTML = `
        <div class="food-card-img">🥐<span class="badge-floating">Tersedia</span></div>
        <div class="food-card-body">
          <h4>${foodName}</h4>
          <div class="food-location">📍 Restoran Sederhana Balikpapan</div>
          <div class="food-qty">${qtyStr} porsi</div>
          <button class="btn-honey btn-card-claim" onclick="initiateClaim('${foodName}', 'Restoran Sederhana Balikpapan', ${qtyStr}, '${category}', '🥐')">Klaim Makanan</button>
        </div>
      `;
      catalogGrid.prepend(col);

      // Show alert donasi sukses
      const donasiAlert = document.getElementById('donasiSuccessAlert');
      donasiAlert.style.display = 'block';
      donasiAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
      
      // Auto-hide alert after 5s
      setTimeout(() => {
        donasiAlert.style.display = 'none';
      }, 5000);
    }

    // Toggle API Accordion
    function toggleApiAccordion(headerElement) {
      const card = headerElement.closest('.api-card');
      card.classList.toggle('open');
    }

    // Filter Catalog
    function filterCatalog(category) {
      // Handle active button class
      const filterPills = document.querySelectorAll('.filter-pill');
      filterPills.forEach(pill => pill.classList.remove('active'));
      
      // Target correct trigger button
      const clickedBtn = Array.from(filterPills).find(p => p.innerText.toLowerCase().includes(category.replace('_', ' ').toLowerCase()) || (category === 'semua' && p.innerText === 'Semua'));
      if(clickedBtn) {
        clickedBtn.classList.add('active');
      }

      // Hide/Show items in grid
      const cards = document.querySelectorAll('#catalogFoodGrid .food-card');
      cards.forEach(card => {
        const itemCat = card.getAttribute('data-category');
        if (category === 'semua' || itemCat === category) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }
