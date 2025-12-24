        </div>
    </main>
    <footer class="glass-footer py-4 mt-auto">
        <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">
            <span class="small">© <?= date('Y') ?> NearBy Student Housing</span>
            <div class="d-flex gap-3 small">
                <a href="#" class="link-light">Privacy</a>
                <a href="#" class="link-light">Terms</a>
                <a href="guidance.php" class="link-light">Support</a>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/main.js"></script>
<?php if (!empty($pageScripts)): ?>
    <?php foreach ($pageScripts as $scriptPath): ?>
        <script src="<?= htmlspecialchars($scriptPath) ?>" type="module"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
