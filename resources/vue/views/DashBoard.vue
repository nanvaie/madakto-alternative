<template>
    <div
        class="fd-margin-top-bottom--tiny fd-has-display-flex fd-has-align-items-center"
        style="justify-content: space-between"
    >
        <div class="fd-has-display-flex">
            <VSLabel
                class="fd-margin-end--tiny"
                show-colon=""
            >
                جمع ساعت کاری
            </VSLabel>
            {{ myTotalFormatted() }}
        </div>

        <div class="fd-has-display-flex">
            <VSButton
                class="fd-margin-end--tiny"
                :disabled="!preventEnteringCheckOut"
                design="Positive"
                @click="enterNewCheckIn"
            >
                ثبت ورود
            </VSButton>
            <VSButton
                class="fd-margin-end--tiny"
                :disabled="preventEnteringCheckOut"
                design="Negative"
                @click="enterNewCheckOut"
            >
                ثبت خروج
            </VSButton>
            <VSButton
                class="fd-margin-end--tiny"
                @click="showDialogById('add-new-record-dialog')"
            >
                ثبت تردد...
            </VSButton>
        </div>
    </div>

    <ui5-dialog
        id="add-new-record-dialog"
        icon="decline"
        header-text="ثبت تردد"
    >
        <div slot="header">
            <ui5-title level="H4">
                ثبت تردد
            </ui5-title>
        </div>
        <div
            slot="header"
            class="dialog-header"
        >
            <ui5-button
                icon="decline"
                tooltip="بستن پنجره"
                design="Transparent"
                @click="closeDialogById('add-new-record-dialog')"
            />
        </div>

        <div>
            <ui5-label
                id="check-in-datetime-label"
                for="check-in-datetime"
                show-colon=""
            >
                زمان ورود
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="check-in-datetime"
                    dir="ltr"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div>
            <ui5-label
                id="check-out-datetime-label"
                for="check-out-datetime"
                show-colon=""
            >
                زمان خروج
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="check-out-datetime"
                    dir="ltr"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div
            class="fd-has-display-flex fd-has-align-items-center"
            slot="footer"
            style="justify-content: end; width: 100%;"
        >
            <ui5-button
                id="save-record-button"
                design="Emphasized"
                @click="saveRecord"
            >
                ذخیره
            </ui5-button>
        </div>
    </ui5-dialog>

    <ui5-dialog
        id="edit-record-dialog"
        icon="decline"
        header-text="ویرایش تردد"
    >
        <div slot="header">
            <ui5-title level="H4">
                ویرایش تردد
            </ui5-title>
        </div>
        <div
            slot="header"
            class="dialog-header"
        >
            <ui5-button
                icon="decline"
                tooltip="بستن پنجره"
                design="Transparent"
                @click="closeDialogById('edit-record-dialog')"
            />
        </div>

        <div>
            <ui5-label
                id="edit-check-in-datetime-label"
                for="edit-check-in-datetime"
                show-colon=""
            >
                زمان ورود
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="edit-check-in-datetime"
                    dir="ltr"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div>
            <ui5-label
                id="edit-check-out-datetime-label"
                for="edit-check-out-datetime"
                show-colon=""
            >
                زمان خروج
            </ui5-label>
            <div>
                <ui5-datetime-picker
                    id="edit-check-out-datetime"
                    dir="ltr"
                    format-pattern="yyyy-MM-dd HH:mm:ss"
                />
            </div>
        </div>

        <div
            class="fd-has-display-flex fd-has-align-items-center"
            slot="footer"
            style="justify-content: end; width: 100%;"
        >
            <ui5-button
                id="edit-record-button"
                design="Emphasized"
                @click="editRecord"
            >
                ویرایش
            </ui5-button>
        </div>
    </ui5-dialog>

    <ui5-table
        sticky-column-header
        no-data-text="داده‌ای موجود نیست!"
    >
        <ui5-table-column slot="columns">
            روز ورود
        </ui5-table-column>
        <ui5-table-column slot="columns">
            تاریخ ورود
        </ui5-table-column>
        <ui5-table-column slot="columns">
            ساعت ورود
        </ui5-table-column>
        <ui5-table-column slot="columns">
            روز خروج
        </ui5-table-column>
        <ui5-table-column slot="columns">
            تاریخ خروج
        </ui5-table-column>
        <ui5-table-column slot="columns">
            ساعت خروج
        </ui5-table-column>
        <ui5-table-column slot="columns">
            نتیجه
        </ui5-table-column>

        <ui5-table-row
            v-for="record of records"
            :key="record.id"
        >
            <ui5-table-cell>{{ getDayName(record.checkIn, 'fa-IR') }}</ui5-table-cell>
            <ui5-table-cell>{{ getDate(record.checkIn) }}</ui5-table-cell>
            <ui5-table-cell>{{ getTime(record.checkIn) }}</ui5-table-cell>
            <ui5-table-cell>{{ record.checkOut !== undefined ? getDayName(record.checkOut, 'fa-IR') : '---' }}</ui5-table-cell>
            <ui5-table-cell>{{ record.checkOut !== undefined ? getDate(record.checkOut) : '---' }}</ui5-table-cell>
            <ui5-table-cell>{{ record.checkOut !== undefined ? getTime(record.checkOut) : '---' }}</ui5-table-cell>
            <ui5-table-cell>{{ record.checkOut !== undefined ? calculateTimeDifference(record.checkIn, record.checkOut) : '---' }}</ui5-table-cell>
            <ui5-table-cell class="fd-has-display-flex">
                <VSButton
                    :data-record-id="record.id"
                    @click="handleEditRecord"
                >
                    ویرایش
                </VSButton>
            </ui5-table-cell>
        </ui5-table-row>
    </ui5-table>

    <ui5-dialog
        id="error-state-dialog"
        header-text="خطا در ثبت تردد"
        state="Error"
    >
        <p>زمان خروج نباید کمتر از زمان ورود باشد!</p>
        <div
            slot="footer"
            style="display: flex; justify-content: flex-end; width: 100%; padding: .25rem 1rem;"
        >
            <ui5-button
                id="error-close"
                @click="closeDialogById('error-state-dialog')"
            >
                بستن
            </ui5-button>
        </div>
    </ui5-dialog>
</template>

<script setup>

import '@ui5/webcomponents/dist/Table';
import '@ui5/webcomponents/dist/TableColumn';
import '@ui5/webcomponents/dist/TableRow';
import '@ui5/webcomponents/dist/TableCell';
import '@ui5/webcomponents/dist/DateTimePicker';
import '@ui5/webcomponents-localization/dist/features/calendar/Persian';
import { computed, ref } from 'vue';
import Pasoonate from 'pasoonate';
import VSButton from '../components/SAP-UI5/VSButton.vue';
import VSLabel from '../components/SAP-UI5/VSLabel.vue';

/**
 * @type []
 */
const localRecords = JSON.parse(localStorage.getItem('my_records'));

const records = ref(localRecords !== null ? localRecords : []);

let preventEnteringCheckOut;
const lastRecord = records.value[records.value.length - 1];

if (lastRecord !== undefined && lastRecord.checkOut === undefined) {
    preventEnteringCheckOut = ref(false);
} else {
    preventEnteringCheckOut = ref(true);
}

function showDialogById(dialogId, targetRef) {
    document.getElementById(dialogId).show(targetRef);
}

function closeDialogById(dialogId) {
    document.getElementById(dialogId).close();
}

function getDate(timestamp) {
    const date = new Date(timestamp * 1000);

    return date.toLocaleDateString('fa-IR');
}

function getTime(timestamp) {
    const date = new Date(timestamp * 1000);

    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
}

function calculateTimeDifference(checkInTimestamp, checkOutTimestamp) {
    const difference = checkOutTimestamp - checkInTimestamp;

    const hours = Math.floor(difference / 3600).toString().padStart(2, '0');
    const minutes = (Math.floor(difference / 60) % 60).toString().padStart(2, '0');
    const seconds = (difference % 60).toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
}

function enterNewCheckIn() {
    preventEnteringCheckOut.value = false;

    records.value.push({
        id: records.value.length + 1,
        checkIn: Math.floor(Date.now() / 1000),
    });

    localStorage.setItem('my_records', JSON.stringify(records.value));
}

function enterNewCheckOut() {
    preventEnteringCheckOut.value = true;

    records.value[records.value.length - 1].checkOut = Math.floor(Date.now() / 1000);

    localStorage.setItem('my_records', JSON.stringify(records.value));
}

function getDayName(timestamp, locale) {
    return (new Date(timestamp * 1000)).toLocaleDateString(locale, { weekday: 'long' });
}

function sortRecords(unsortedRecords) {
    return unsortedRecords.sort((firstRecord, secondRecord) => firstRecord.checkIn > secondRecord.checkIn);
}

function saveRecord() {
    const checkInTimestamp = Pasoonate.make().jalali(document.getElementById('check-in-datetime').value).getTimestamp();
    const checkOutTimestamp = Pasoonate.make().jalali(document.getElementById('check-out-datetime').value).getTimestamp();

    if (checkOutTimestamp < checkInTimestamp) {
        closeDialogById('add-new-record-dialog');
        showDialogById('error-state-dialog');

        return;
    }

    records.value.push({
        id: records.value.length + 1,
        checkIn: checkInTimestamp,
        checkOut: checkOutTimestamp,
    });

    records.value = sortRecords(records.value);

    localStorage.setItem('my_records', JSON.stringify(records.value));

    closeDialogById('add-new-record-dialog');
}

function findRecordById(recordId) {
    let result;

    records.value.forEach((record, index) => {
        if (record.id === recordId) {
            result = {
                record,
                index,
            };
        }
    });

    if (result === undefined) {
        return 'not found';
    }

    return result;
}

function handleEditRecord(event) {
    const foundRecord = findRecordById(+event.target.dataset.recordId);

    document.getElementById('edit-check-in-datetime').value = Pasoonate.make(foundRecord.record.checkIn).jalali().format('yyyy-MM-dd HH:mm:ss');
    document.getElementById('edit-check-out-datetime').value = Pasoonate.make(foundRecord.record.checkOut).jalali().format('yyyy-MM-dd HH:mm:ss');
    document.getElementById('edit-record-button').dataset.recordIndex = foundRecord.index;

    showDialogById('edit-record-dialog');
}

function editRecord(event) {
    const editedCheckInTimestamp = Pasoonate.make().jalali(document.getElementById('edit-check-in-datetime').value).getTimestamp();
    const editedCheckOutTimestamp = Pasoonate.make().jalali(document.getElementById('edit-check-out-datetime').value).getTimestamp();

    if (editedCheckOutTimestamp < editedCheckInTimestamp) {
        closeDialogById('edit-record-dialog');
        showDialogById('error-state-dialog');

        return;
    }

    records.value[event.target.dataset.recordIndex].checkIn = editedCheckInTimestamp;
    records.value[event.target.dataset.recordIndex].checkOut = editedCheckOutTimestamp;

    records.value = sortRecords(records.value);

    localStorage.setItem('my_records', JSON.stringify(records.value));

    closeDialogById('edit-record-dialog');
}

const myTotal = computed(() => records.value.reduce((sumOfDifference, currentRecord) => {
    if (currentRecord.checkOut === undefined) {
        return sumOfDifference;
    }

    return sumOfDifference + (currentRecord.checkOut - currentRecord.checkIn);
}, 0));

const myTotalFormatted = () => {
    const hours = Math.floor(myTotal.value / 3600).toString().padStart(2, '0');
    const minutes = (Math.floor(myTotal.value / 60) % 60).toString().padStart(2, '0');
    const seconds = (myTotal.value % 60).toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
};

</script>

<style scoped>

.dialog-header {
    display: flex;
    align-items: center;
    justify-content: end;
    width: 100%;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

</style>
